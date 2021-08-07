<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class LoadUserFromToken
{
    const TOKEN_HEADER_KEY = 'token';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader(self::TOKEN_HEADER_KEY)) {
            $token = $request->header(self::TOKEN_HEADER_KEY);

            $user = User::query()->where('api_token', $token)->first();

            if (!$user) {
                throw new UnauthorizedException('Login required');
            }

            $request->session()->put('user', $user);
        } else {
            throw new UnauthorizedException('No session started');
        }

        return $next($request);
    }
}
