<?php

use App\Http\Controllers\Blog\ActionsController;
use App\Http\Controllers\Blog\FrontController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontController::class, 'index'])
    -> name('blog.index');

Route::get('/register', [FrontController::class, 'register'])
    -> name('blog.register');
Route::post('/register', [ActionsController::class, 'register'])
    -> name('blog.actions.register');

Route::get('/exit', [ActionsController::class, 'exit'])
    -> name('blog.actions.exit');

Route::get('/login', [FrontController::class, 'login'])
    -> name('blog.login');
Route::post('/login', [ActionsController::class, 'login'])
    -> name('blog.actions.login');