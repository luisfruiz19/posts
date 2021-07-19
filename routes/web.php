<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    return view('auth.login');
})->middleware('guest');
Route::get('/test',function(){
    return Storage::path('file');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/posts',\App\Http\Controllers\PostController::class);
Route::resource('/files',\App\Http\Controllers\FileController::class);
Route::resource('/tags',\App\Http\Controllers\TagController::class);
Route::resource('/comments',\App\Http\Controllers\CommentController::class);

Route::get('/file/${id}',[\App\Http\Controllers\FileController::class,'getfile'])->name('show.file');
