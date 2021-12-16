<?php
    
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Analytic;

class AnalyticLogger
{
    public function handle(Request $request, Closure $next)
        {
        $response = $next($request);
    
        if ($request->routeIs('analytics.index')) {
            return $response;
        }
        
        $request = Analytic::create([
            'url' => $request->getPathInfo(),
            'method' => $request->method(),
            'response_time' => time() - $_SERVER['REQUEST_TIME'],
        ]);
    
        return $response;
    }
}