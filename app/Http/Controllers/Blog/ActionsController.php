<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ActionsController extends Controller
{
    public function register(Request $request)
    {
        $request -> validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must not exceed 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.unique' => 'The email address you entered is already in use.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password field must be a string.',
            'password.min' => 'The password field must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        $user = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
        ]);
        Auth::login($user);

        return redirect()
            -> route('blog.index');
    }

    public function login(Request $request)
    {
        $request -> validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password field must be a string.',
            'password.min' => 'The password field must be at least 8 characters.',
        ]);

        $credentials = $request -> only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()
                -> route('blog.index');
        } else {
            return redirect()
                -> route('blog.login')
                -> with('error', 'The email address or password you entered is incorrect.');
        }
    }

    public function exit()
    {
        Auth::logout();

        return redirect()
            -> route('blog.index');
    }
}
