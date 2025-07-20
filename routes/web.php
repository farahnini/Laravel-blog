<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('articles.index');
});

// Article routes (explicit, not resource)
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index')->middleware('auth');
Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create')->middleware('auth');
Route::post('articles', [ArticleController::class, 'store'])->name('articles.store')->middleware('auth');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show')->middleware('auth');
Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit')->middleware('auth');
Route::post('articles/{article}/update', [ArticleController::class, 'update'])->name('articles.update')->middleware('auth');
Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('auth');
Route::post('articles/{article}/comments', [ArticleController::class, 'commentsStore'])->name('articles.comments.store')->middleware('auth');
Route::post('articles/{article}/comments/{comment}/delete', [ArticleController::class, 'commentDelete'])->name('articles.comments.delete')->middleware('auth');
Route::post('articles/{article}/like', [ArticleController::class, 'reactionLike'])->name('articles.like')->middleware('auth');
Route::post('articles/{article}/dislike', [ArticleController::class, 'reactionDislike'])->name('articles.dislike')->middleware('auth');
Route::get('articles/{article}/comments/{comment}/edit', [ArticleController::class, 'commentEdit'])->name('articles.comments.edit')->middleware('auth');
Route::post('articles/{article}/comments/{comment}/update', [ArticleController::class, 'commentUpdate'])->name('articles.comments.update')->middleware('auth');

// User and role management (admin check in controller)
Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('users', [UserController::class, 'store'])->name('users.store')->middleware('auth');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::post('users/{user}/update', [UserController::class, 'update'])->name('users.update')->middleware('auth');

Route::get('roles', [RoleController::class, 'index'])->name('roles.index')->middleware('auth');
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('auth');
Route::post('roles', [RoleController::class, 'store'])->name('roles.store')->middleware('auth');
Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('auth');
Route::post('roles/{role}/update', [RoleController::class, 'update'])->name('roles.update')->middleware('auth');
Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
