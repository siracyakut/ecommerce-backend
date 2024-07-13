<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Exceptions;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
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
        $token = $request->cookie('token');
        if ($token) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof Exceptions\TokenInvalidException) {
                $success = false;
                $data = 'Invalid token. Please login.';
                return response()->json(compact('success', 'data'), 401);
            } else if ($e instanceof Exceptions\TokenExpiredException) {
                try {
                    $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                    $user = JWTAuth::setToken($refreshed)->toUser();
                    $request->headers->set('Authorization', 'Bearer ' . $refreshed);
                    return $next($request)->cookie('token', $refreshed, 5256000, '/', null, true, true, false, 'none');
                } catch (Exceptions\JWTException $e) {
                    $success = false;
                    $data = 'Token cannot be refreshed, please login again.';
                    return response()->json(compact('success', 'data'), 401);
                }
            } else {
                $success = false;
                $data = 'Token not found. Please login.';
                return response()->json(compact('success', 'data'), 401);
            }
        }
        return $next($request);
    }
}
