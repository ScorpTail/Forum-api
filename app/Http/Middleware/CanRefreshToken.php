<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class CanRefreshToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('token.refresh') || !$this->isRefreshTokenRequest()) {
            return $next($request);
        }

        return response()->json(['message' => 'Access denied for refresh token'], HttpResponse::HTTP_FORBIDDEN);
    }

    private function isRefreshTokenRequest(): bool
    {
        return Auth::check() && Auth::user()->currentAccessToken()->name === 'refreshToken';
    }
}
