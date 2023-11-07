<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        return view('blog.index');
    }

    public function register()
    {
        return !Auth::check()
            ? view('blog.register', [
                'title' => 'Register',
            ])
            : redirect()
                -> route('blog.index')
                -> with('error', 'You are already logged in!');
    }

    public function login()
    {
        return !Auth::check()
            ? view('blog.login', [
                'title' => 'Login',
            ])
            : redirect()
                -> route('blog.index')
                -> with('error', 'You are already logged in!');
    }

    public function account()
    {
        return Auth::check()
            ? view('blog.account', [
                'title' => 'Account',
            ])
            : redirect()
                -> route('blog.index')
                -> with('error', 'You are not logged in!');
    }

    public function blog()
    {
        return Auth::check()
            ? view('blog.blog', [
                'title' => 'Blog',
            ])
            : redirect()
                -> route('blog.index')
                -> with('error', 'You are not logged in!');
    }

    public function add()
    {
        return Auth::check()
            ? view('blog.add', [
                'title' => 'Add',
            ])
            : redirect()
                -> route('blog.index')
                -> with('error', 'You are not logged in!');
    }

    public function edit($id)
    {
        return Auth::check()
            ? view('blog.edit', [
                'post' => Post::findOrFail($id),
                'title' => 'Edit',
            ])
            : redirect()
                -> route('blog.index')
                -> with('error', 'You are not logged in!');
    }

    public function personal(int $user_id)
    {
        return view('blog.personal', [
            'title' => 'Personal',
            'posts' => User::findOrFail($user_id)
                -> posts()
                -> paginate(10),
        ]);
    }

    public function personalPost(int $post_id)
    {
        return view('blog.personal_post', [
            'title' => 'Personal Post',
            'post' => Post::findOrFail($post_id),
        ]);
    }
}
