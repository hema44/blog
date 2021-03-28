<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use App\Models\Post;
use Closure;
use Illuminate\Http\Request;

class Commentmiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $usertest = Comment::find($request->route('id'));
        $user = auth()->id();
        if ( $user !== $usertest->user_id){
            return response()->json(['status' => 'you not allawed to do that']);
        }

        return $next($request);
    }
}
