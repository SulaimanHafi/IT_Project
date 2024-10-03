<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $posts = [];
    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get(); // Untuk memanggil data berdasarkan terakhir kali dibuat
    }
    // $posts = Post::where('user_id', auth()->id())->get(); //untuk memanggil berdasarkan user_id yang login
    // $posts = Post::all(); untuk memanggil semua post
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

//blog post related routes
Route::post('/create-post', [postController::class, 'createPost']);
Route::get('/edit-post/{post}', [postController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [postController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [postController::class, 'deletePost']);
