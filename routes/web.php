    <?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Responses\LoginResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostController as ControllersPostController;
use App\Http\Controllers\QueryBuilderPrueba;
use App\Http\Controllers\RegisterController;
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

//Register Controller
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


//Login Controller
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

//Logout Controller
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Rutas para la foto de perfil

Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

// Geters Posts
Route::get('/{user:username}',[PostController::class, 'index'])->name('posts.index');

// Envia a la pestaña de crear 
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');

// Crea un post ruta
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Obtiene un ruta al momento de crear un post
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('post.show');

//Comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

// Delete de posts
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//Like a fotos
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');


// Siguiendo Usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'sotre'])->name('users.follow'); // Guardar que esta siguiendo a un usuario
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow'); // Eliminar el follow
