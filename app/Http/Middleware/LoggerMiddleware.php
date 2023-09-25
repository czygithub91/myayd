<?php

namespace App\Http\Middleware;

use App\Models\RequestInfo;
use Carbon\Carbon;
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
        $request_info = new RequestInfo();
        $request_info->setTable('request_info_' . Carbon::now()->format('Ymd'));
        $request_info->uuid = (string)Str::uuid();
        $request_info->method = $request->method();
        $request_info->path = $request->url();
        $request_info->request_data = json_encode($request->all());
        $request_info->response_data = $response_data;
        $request_info->save();
        return;
    }
}
