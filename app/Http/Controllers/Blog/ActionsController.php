<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Comment;
use App\Models\Blog\Like;
use App\Models\Blog\Post;
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

    public function add(Request $request)
    {
        $request -> validate([
            'heading' => 'required|string|max:255',
            'body' => 'required|string',
            'is_draft' => 'boolean',
            'is_paid' => 'boolean',
            'amount' => 'required_if:is_paid,1|nullable|integer|min:1',
        ], [
            'heading.required' => 'The heading field is required.',
            'heading.string' => 'The heading field must be a string.',
            'heading.max' => 'The heading field must not exceed 255 characters.',
            'body.required' => 'The body field is required.',
            'body.string' => 'The body field must be a string.',
            'is_draft.required' => 'The is draft field is required.',
            'is_draft.boolean' => 'The is draft field must be a boolean.',
            'is_paid.required' => 'The is paid field is required.',
            'is_paid.boolean' => 'The is paid field must be a boolean.',
            'amount.required_if' => 'The amount field is required.',
            'amount.nullable' => 'The amount field must be a number.',
            'amount.integer' => 'The amount field must be an integer.',
            'amount.min' => 'The amount field must be at least 1.',
        ]);

        $user = Auth::user();
        $user -> posts() -> create([
            'heading' => $request -> heading,
            'body' => $request -> body,
            'is_draft' => $request -> is_draft ?? false,
            'is_paid' => $request -> is_paid ?? false,
            'amount' => $request -> amount,
            'user_id' => $user -> id,
        ]);

        return redirect()
            -> route('blog.account');
    }

    public function edit(Request $request, int $id)
    {
        $request -> validate([
            'heading' => 'required|string|max:255',
            'body' => 'required|string',
            'is_draft' => '',
            'is_paid' => '',
            'amount' => 'required_if:is_paid,on|nullable|integer|min:1',
        ], [
            'heading.required' => 'The heading field is required.',
            'heading.string' => 'The heading field must be a string.',
            'heading.max' => 'The heading field must not exceed 255 characters.',
            'body.required' => 'The body field is required.',
            'body.string' => 'The body field must be a string.',
            'is_draft.required' => 'The is draft field is required.',
            'is_draft.boolean' => 'The is draft field must be a boolean.',
            'is_paid.required' => 'The is paid field is required.',
            'is_paid.boolean' => 'The is paid field must be a boolean.',
            'amount.required_if' => 'The amount field is required.',
            'amount.nullable' => 'The amount field must be a number.',
            'amount.integer' => 'The amount field must be an integer.',
            'amount.min' => 'The amount field must be at least 1.',
        ]);

        $user = Auth::user();
        $post = Post::findOrFail($id);
        $post -> update([
            'heading' => $request -> heading,
            'body' => $request -> body,
            'is_draft' => $request -> is_draft ?? false,
            'is_paid' => $request -> is_paid ?? false,
            'amount' => $request -> amount,
            'user_id' => $user -> id,
        ]);

        return redirect()
            -> route('blog.blog');
    }

    public function delete(int $id)
    {
        $post = Post::findOrFail($id);
        $post -> delete();

        return redirect()
            -> route('blog.blog');
    }

    public function like(int $id)
    {
        $user = Auth::user();
        $post = Post::findOrFail($id);

        if ($user
            -> likes()
            -> where('likeable_type', Post::class)
            -> where('likeable_id', $post -> id)
            -> exists()
        ) {
            Like::where('user_id', $user -> id)
                -> where('likeable_type', Post::class)
                -> where('likeable_id', $post -> id)
                -> delete();
        } else {
            $user -> likes() -> create([
                'user_id' => $user -> id,
                'likeable_type' => Post::class,
                'likeable_id' => $post -> id,
            ]);
        }

        return redirect()
            -> route('blog.personal.post', ['post_id' => $id]);
    }

    public function comment(Request $request, int $id)
    {
        $request -> validate([
            'body' => 'required|string',
        ], [
            'body.required' => 'The body field is required.',
            'body.string' => 'The body field must be a string.',
        ]);

        $user = Auth::user();
        $post = Post::findOrFail($id);
        $post -> comments() -> create([
            'body' => $request -> body,
            'user_id' => $user -> id,
        ]);

        return redirect()
            -> route('blog.personal.post', ['post_id' => $id]);
    }

    public function commentLike(Request $request, int $id, int $comment_id)
    {
        $user = Auth::user();
        $post = Post::findOrFail($id);
        $comment = $post -> comments() -> findOrFail($comment_id);

        if ($user
            -> likes()
            -> where('likeable_type', Comment::class)
            -> where('likeable_id', $comment -> id)
            -> exists()
        ) {
            Like::where('user_id', $user -> id)
                -> where('likeable_type', Comment::class)
                -> where('likeable_id', $comment -> id)
                -> delete();
        } else {
            $user -> likes() -> create([
                'user_id' => $user -> id,
                'likeable_type' => Comment::class,
                'likeable_id' => $comment -> id,
            ]);
        }

        return redirect()
            -> route('blog.personal.post', ['post_id' => $id]);
    }
}
