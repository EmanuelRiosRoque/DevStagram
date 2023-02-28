<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Responses\LoginResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostController as ControllersPostController;
use App\Http\Controllers\QueryBuilderPrueba;
use App\Models\User;
use Illuminate\Auth\Events\Logout;

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
    return view('welcome');
});

    // Route::get('/home', function () {
    //      return view('dashboard');
    // })->middleware('auth');


// Route::get('/', [QueryBuilderPrueba::class, 'pruebas'])->name('welcome');

//Login Controller
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

//Logout Controller
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');


// Geters Posts
Route::get('/{user:username}',[PostController::class, 'index'])->name('posts.index');
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('post.show');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');