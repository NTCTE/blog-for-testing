<?php

use App\Http\Controllers\Blog\ActionsController;
use App\Http\Controllers\Blog\FrontController;
use App\Http\Middleware\Payments\AcquiringMiddleware;
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

Route::get('/account', [FrontController::class, 'account'])
    -> name('blog.account');

Route::get('/blog', [FrontController::class, 'blog'])
    -> name('blog.blog');

Route::get('/blog/add', [FrontController::class, 'add'])
    -> name('blog.add');
Route::post('/blog/add', [ActionsController::class, 'add'])
    -> name('blog.actions.add');

Route::get('/blog/edit/{id}', [FrontController::class, 'edit'])
    -> name('blog.edit');
Route::post('/blog/edit/{id}', [ActionsController::class, 'edit'])
    -> name('blog.actions.edit');

Route::get('/blog/delete/{id}', [ActionsController::class, 'delete'])
    -> name('blog.actions.delete');

Route::get('/blog/personal/{user_id}', [FrontController::class, 'personal'])
    -> name('blog.personal');

Route::get('/blog/personal/post/{post_id}', [FrontController::class, 'personalPost'])
    -> name('blog.personal.post')
    -> middleware(AcquiringMiddleware::class);
Route::get('/blog/personal/post/{post_id}/like', [ActionsController::class, 'like'])
    -> name('blog.personal.post.like');

Route::post('/blog/personal/post/{post_id}/comment', [ActionsController::class, 'comment'])
    -> name('blog.personal.post.comment');
Route::get('/blog/personal/post/{post_id}/comment/{comment_id}/like', [ActionsController::class, 'commentLike'])
    -> name('blog.personal.post.comment.like');

Route::get('/blog/payment', fn() => view('blog.payment'))
    -> name('blog.payment');