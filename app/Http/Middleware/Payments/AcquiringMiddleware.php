<?php

namespace App\Http\Middleware\Payments;

use App\Models\Blog\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcquiringMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = Post::findOrFail($request -> post_id);
        if (!$post -> is_paid())
        {
            return redirect()
                -> route('blog.payment');
        } else return $next($request);
    }
}
