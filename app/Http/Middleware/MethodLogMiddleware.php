<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MethodLogMiddleware
{

    public function handle($request, Closure $next)
    {
        $startTime = microtime(true);
        $requestUri = $request->getRequestUri();
        $requestMethod = $request->getMethod();
        $userAgent = $request->header('User-Agent');


        $response = $next($request);

        $routeName = Route::currentRouteName() ?? null;
        $docId = $request->doc_id ?? null;

        $userId = Auth::id() ?? null;
        $userName = Auth::user()->name ?? null;
        $sessionId = Session::getId() ?? null;

        $endTime = microtime(true);
        $timeTaken = ($endTime - $startTime) ;
        $milliseconds = floor($timeTaken * 1000);

        $logMessage = [
            'method' => $requestMethod,
            'uri' => $requestUri,
            'route' => $routeName,
            'time' => $milliseconds,
            'user_id' => $userId,
            'user_name' => $userName,
            'session_id' => $sessionId,
            'doc_id' => $docId,
            'status_code' => $response->getStatusCode(),
        ];

        Log::channel('methodlog')->info('Action logs ', $logMessage);

        return $response;
    }
}
