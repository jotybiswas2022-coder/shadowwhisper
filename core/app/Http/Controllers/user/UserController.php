<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Contact us form
    public function contactus(Request $request)
{
    $key = 'contact-form-'.$request->ip();

    // ⛔ limit: 1 request প্রতি 10 সেকেন্ডে
    if (RateLimiter::tooManyAttempts($key, 1)) {
        return back()->withErrors([
            'message' => 'Too many attempts. Please wait a few seconds.'
        ]);
    }

    RateLimiter::hit($key, 10); // 10 seconds cooldown

    $validated = $request->validate([
        'name' => 'nullable|string|max:255',
        'email'=> 'nullable|email|max:255',
        'message'=> 'required|string|min:5|max:1000',
    ]);

    Contact::create($validated);

    return back()->with('success', 'Message sent successfully!');
}

    // Show user posts
    public function mystories()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->get();
        $categories = Category::all();

        return view('frontend.user.posts.index', compact('posts','categories'));
    }

    // Show create post form
    public function create()
    {
        $categories = Category::all();
        return view('frontend.user.posts.create', compact('categories'));
    }

    // Store new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'details'     => 'nullable|string',
            'file'        => 'required|file|mimetypes:image/jpeg,image/png,image/gif,image/webp,video/mp4|max:512000',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('posts','public');
        }

        Post::create([
            'title'       => $validated['title'],
            'details'     => $validated['details'] ?? '',
            'status'      => 0,
            'user_id'     => Auth::id(),
            'file'        => $filePath,
        ]);

        return redirect()->route('posts.mystories')->with('success','Post added successfully!');
    }

    // View uploaded file
    public function viewFile($id)
    {
        $post = Post::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        if (!$post->file || !Storage::disk('public')->exists($post->file)) {
            abort(404);
        }

        return response()->file(storage_path('app/public/' . $post->file));
    }

  // DELETE POST
    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->file && Storage::disk('public')->exists($post->file)) {
            Storage::disk('public')->delete($post->file);
        }

        $post->delete();

        return redirect('/mystories')->with('success','Post deleted successfully!');
    }
 }