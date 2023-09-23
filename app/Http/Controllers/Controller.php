<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Define a successful response format
     * @param $data
     * @param string $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data, string $message = 'OK', $code = HttpResponse::HTTP_OK)
    {
        $response_data = [
            'data' => $data,
            'code' => $code,
            'msg' => $message,
        ];
        return response()->json($response_data);
    }


    /**
     * Define a unsuccessful response format
     * @param $data
     * @param string $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function unsuccess($data, string $message = 'unsuccess', $code = 0)
    {
        $response_data = [
            'data' => $data,
            'code' => $code,
            'msg' => $message,
        ];
        return response()->json($response_data);
    }
}
