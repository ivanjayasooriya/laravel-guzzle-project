<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])
    ->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])
    ->name('posts.store');

Route::get('/posts/{id}', [PostController::class, 'show'])
    ->whereNumber('id')
    ->name('posts.show');

Route::get('/posts/{id}/edit', [PostController::class, 'edit'])
    ->whereNumber('id')
    ->name('posts.edit');

Route::put('/posts/{id}', [PostController::class, 'update'])
    ->whereNumber('id')
    ->name('posts.update');

Route::delete('/posts/{id}', [PostController::class, 'destroy'])
    ->whereNumber('id')
    ->name('posts.destroy');
