<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [ HomeController::class, 'home'])->name('home');
Route::post('/articles/comment', [ HomeController::class, 'addComment'])->name('article.add.comment');
Route::get('/articles/{article}', [ HomeController::class, 'article'])->name('home.article');

Route::post('/search', [ HomeController::class, 'search'])->name('article.search');
Route::get('/logout', [ AuthController::class, 'logout'])->name('logout');


Route::middleware('guest')->group(function() {
  Route::get('/login', [ AuthController::class, 'login' ])->name('login');
  Route::post('/login/validated', [ AuthController::class, 'loginValidation' ])->name('login.validation');
});

Route::middleware('auth')->group(function() {
  Route::get('/admin', [ AdminController::class, 'index'])->name('admin.index');
  Route::post('admin/add-article', [ AdminController::class, 'addArticle'])->name('admin.article.add');
  Route::delete('admin/delete-article', [ AdminController::class, 'index'])->name('admin.article.delete');
});
