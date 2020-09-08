<?php

namespace App\Http\Middleware;

use Closure;

class OwnUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = $request->header('Authorization') ? $request->header('Authorization') : "";

        if($userId !== $request->route('id')){
            return response()->json(['message' => 'Access Forbidden'], 403);
        }
        return $next($request);
    }
}
