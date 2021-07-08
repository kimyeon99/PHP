<?php

use App\Http\Controllers\PostsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/posts/create', [PostsController::class, 'create'])/* ->middleware(['auth']) */->name('posts.create');;
Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');;
Route::get('/posts/index', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/show/{id}', [PostsController::class, 'show'])->name('posts.show');
Route::get('/posts/myPost', [PostsController::class, 'myPost'])->name('posts.myPost');

Route::get('/posts/{post}', [PostsController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostsController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('posts.delete');


// post -> 등록:post, 수정:patch || put, 제거:delete
// 위와 같은 방식이 요즘 추세임.
