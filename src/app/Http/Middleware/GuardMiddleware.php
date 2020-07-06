<?php

namespace App\Http\Middleware;

use App\Http\Resources\Error;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class GuardMiddleware
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
        $apiKey = $request->headers->get('X-API-KEY');
        $refApiKey = env('X_API_KEY', 'X_API_KEY');
        if ($apiKey !== $refApiKey) {
            Log::error('Неверный ключ приложения');
            $error = new Error([
                'id' => 1,
                'status' => 403,
                'title' => 'Неверный ключ приложения',
            ]);
            return new JsonResponse($error->resource, 403);
        }
        return $next($request);
    }
}
