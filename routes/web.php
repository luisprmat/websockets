<?php

use App\Http\Controllers\PostController;
use App\Http\Livewire\PostsList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::middleware(['auth:sanctum', 'verified'])->group(function () {});

Route::view('/', 'dashboard')->name('dashboard');
Route::get('posts', PostsList::class)->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
