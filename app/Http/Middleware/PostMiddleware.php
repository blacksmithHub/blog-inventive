<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $postId = $request->route()->parameters()['post']; // 1
        $user = auth()->user();

        $post = Post::find($postId);

        if ($post->user_id === $user->id) {
            return $next($request);
        } else {
            // return redirect()->back();
            abort(403, 'This is unauthorized page.');
        }
    }
}
