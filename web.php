<?php

use App\Http\Controllers\TestController;
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
    return view('welcome'); // welcome이라는 blade php를 실행하라란 뜻
});

Route::get('/test', function () { // 주소창에 localhost:8000/test
    return '헬로';
});

Route::get('/test2', function () {
    return view('test.index'); // test/index랑 같음
});

Route::get('/test3', function () {
    // 비지니스 로직 처리
    $name = '홍길동';
    $age = 20;
    //return view('test.show', ['name' => $name, 'age' => 10]);
    return view('test.show', compact('name', 'age'));
});

//다른 곳에 있는 class 이기 때문에 임포트해야함 cltl + i
Route::get('/test4', [TestController::class, 'index']); // 실행할 클래스의 , 메소드

Route::get('/posts/create', [PostsController::class, 'create']);
