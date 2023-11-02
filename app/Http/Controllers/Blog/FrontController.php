<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
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
            ? view('blog.register')
            : redirect()
                -> route('blog.index')
                -> with('error', 'You are already logged in!');
    }

    public function login()
    {
        return !Auth::check()
            ? view('blog.login')
            : redirect()
                -> route('blog.index')
                -> with('error', 'You are already logged in!');
    }
}
