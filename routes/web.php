<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogLikeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Resume\ResumeController;
use App\Http\Controllers\UserBlogController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', [ResumeController::class, 'index'])->name('home');

Route::get('/resume/editor', [ResumeController::class, 'modify'])->name('resume.editor');
Route::post('/resume/editor', [ResumeController::class, 'store']);

// Route::get('/user/{user:username}/posts' , [UserBlogController::class, 'index'])->name('user.posts');

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/logout' , [LogoutController::class, 'store'])->name('logout');

Route::get('/login' , [LoginController::class, 'index'])->name('login');
Route::post('/login' , [LoginController::class, 'store']);

Route::get('/register' , [RegisterController::class, 'index'])->name('register');
Route::post('/register' , [RegisterController::class, 'store']);

// Route::get('/blog' , [BlogController::class, 'index'])->name('blog');
// Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('posts.show');
// Route::post('/blog' , [BlogController::class, 'store']);
// Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');

// Route::post('/blog/{blog}/likes' , [BlogLikeController::class, 'store'])->name('posts.likes');
// Route::delete('/blog/{blog}/likes' , [BlogLikeController::class, 'destroy']);
