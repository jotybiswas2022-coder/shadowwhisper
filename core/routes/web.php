<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// ================= Authenticated User Routes =================
Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::post('/contactus', 'contactus')->name('contact.send');
    Route::get('/posts/create', 'create')->name('posts.create');
    Route::post('/posts/store', 'store')->name('posts.store');
    Route::delete('/posts/{id}', 'delete')->name('posts.delete');
    Route::get('/mystories', 'mystories')->name('posts.mystories');
});

// ================= Public Site Routes =================
Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/category/{id}', 'list')->name('category.list');
    Route::get('/post/{id}', 'post')->name('post.show');
    Route::get('/contact', 'contact')->name('contact.index');
});

// ================= Reaction & Comment Routes =================
// Must be POST
Route::post('/reaction', [PostController::class, 'react'])->name('post.react');
Route::post('/comment', [PostController::class, 'comment'])->name('post.comment');
Route::post('/comment/edit/{id}', [PostController::class, 'edit'])->name('comment.edit');
Route::delete('/comment/delete/{id}', [PostController::class, 'destroy'])->name('comment.delete');

// ================= Password Reset Routes =================
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Auth::routes();

include('admin.php');