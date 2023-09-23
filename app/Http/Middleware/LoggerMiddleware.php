<?php

namespace App\Http\Middleware;

use App\Models\RequestInfo;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoggerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $response = $next($request);
            $this->writeLog($request, $response->getContent());
            return $response;
        } catch (Exception $e) {
            $this->writeLog($request, $e->getMessage());
            throw $e;
        }
    }


    /**
     * write log into mysql.
     * @param $request
     * @param $response_data
     * @return void
     */
    public function writeLog($request, $response_data)
    {
        $arr = [
            'uuid' => (string)Str::uuid(),
            'method' => $request->method(),
            'path' => $request->url(),
            'request_data' => json_encode($request->all()),
            'response_data' => $response_data
        ];
        RequestInfo::create($arr);
        return;
    }
}
