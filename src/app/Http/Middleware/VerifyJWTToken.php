<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTToken extends BaseMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'User Not Found']);
            }
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response('Token Invalid', 401);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response('Token Expired', 401);
            } else {
                return response('Authorization Token not found', 401);
            }
        }

        return $next($request);
    }

    /**
     * @param $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($message, $statusCode = 200)
    {
        return response()->json(['message' => $message], $statusCode)->header('x-powered-by', 'Duy Pham');
    }
}
