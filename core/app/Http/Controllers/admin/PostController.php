<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // ================= Post CRUD =================
    public function index()
    {
        $posts = Post::latest()->get();
        $categories = Category::all();

        return view('backend.posts.index', compact('posts','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'details'     => 'nullable|string',
            'status'      => 'nullable|in:0,1',
            'file'        => 'nullable|file|mimetypes:image/jpeg,image/png,image/gif,image/webp,video/mp4|max:512000',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $mime = $file->getMimeType();
            if (!in_array($mime, ['video/mp4','image/jpeg','image/png','image/gif','image/webp'])) {
                return back()->with('error','Only Image and MP4 video allowed!');
            }
            $filePath = $file->store('posts','public');
        }

        Post::create([
            'title'       => $request->title,
            'details'     => $request->details ?? '',
            'status'      => (int)$request->status,
            'user_id'     => Auth::id(),
            'file'        => $filePath,
        ]);

        return redirect('/admin/posts')->with('success','Post added successfully!');
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'status' => 'nullable|in:0,1',
            'file' => 'nullable|file|mimetypes:image/jpeg,image/png,image/gif,image/webp,video/mp4|max:512000',
        ]);

        if ($request->hasFile('file')) {
            if ($post->file && Storage::disk('public')->exists($post->file)) {
                Storage::disk('public')->delete($post->file);
            }
            $post->file = $request->file('file')->store('posts','public');
        }

        $post->title = $request->title;
        $post->details = $request->details ?? '';
        $post->status = (int)$request->status;
        $post->save();

        return redirect('/admin/posts')->with('success','Post updated successfully!');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->file && Storage::disk('public')->exists($post->file)) {
            Storage::disk('public')->delete($post->file);
        }

        $post->delete();

        return redirect('/admin/posts')->with('success','Post deleted successfully!');
    }

    public function viewFile($id)
    {
        $post = Post::findOrFail($id);

        if (!$post->file) {
            abort(404);
        }

        $filePath = storage_path('app/public/' . $post->file);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->file($filePath);
    }

    // ================= Reaction =================
   public function react(Request $request)
{
    $request->validate([
        'post_id' => 'required|exists:posts,id',
        'type'    => 'required|in:like,sad,angry',
    ]);

    $post = Post::findOrFail($request->post_id);
    $userId = auth()->id();

    if (!$userId) {
        return response()->json([
            'success' => false,
        ]);
    }

    $existingReaction = $post->reactions()->where('user_id', $userId)->first();

    if ($existingReaction) {
        if ($existingReaction->type === $request->type) {
            $existingReaction->delete();
        } else {
            $existingReaction->type = $request->type;
            $existingReaction->save();
        }

        return response()->json([
            'success' => true,
            'count'   => $post->reactions()->count(),
        ]);
    }

    $reaction = new Reaction();
    $reaction->post_id = $post->id;
    $reaction->type = $request->type;
    $reaction->user_id = $userId;
    $reaction->save();

    return response()->json([
        'success' => true,
        'count'   => $post->reactions()->count(),
    ]);
}

// ================= Comment =================
public function comment(Request $request)
{
    $request->validate([
        'post_id' => 'required|exists:posts,id',
        'comment' => 'required|string|max:1000'
    ]);

    $comment = new Comment();
    $comment->post_id = $request->post_id;
    $comment->user_id = auth()->id(); // nullable for anonymous
    $comment->comment = $request->comment;
    $comment->save();

    return response()->json([
        'success' => true,
        'comment_id' => $comment->id,
        'comment' => $comment->comment,
        'user_id' => $comment->user_id
    ]);
}

// Edit comment
public function edit(Request $request, $id)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    $comment = Comment::findOrFail($id);

    if ($comment->user_id != auth()->id()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized']);
    }

    $comment->comment = $request->comment;
    $comment->save();

    return response()->json(['success' => true, 'comment' => $comment->comment]);
}

public function destroy($id)
{
    $comment = Comment::findOrFail($id);

    if ($comment->user_id != auth()->id()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized']);
    }

    $comment->delete();

    return response()->json(['success' => true]);
}
}