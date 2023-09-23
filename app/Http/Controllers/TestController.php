<?php

namespace App\Http\Controllers;


use App\Models\Models\RequestInfo;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * normal response json format.
     * @return \Illuminate\Http\JsonResponse
     */
    public function testSuccessResponse()
    {
        return $this->success('hello');
    }

    /**
     * exception response json format.
     * @return \Illuminate\Http\JsonResponse
     */
    public function testExceptionResponse()
    {
        try {
            $zero = 0;
            $result = 1 / $zero;
            return $this->success($result);
        } catch (\Exception $e) {
            //Output json format using the Exception render function.
            throw new \Exception("something wrong");
        }
    }


    /**
     * return request content
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnRequestContent(Request $request)
    {
        return $this->success($request->input());
    }


    /**
     * return expected error
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnExpectedError(Request $request)
    {
        $name = $request->input('name');
        if ($name != 'Ekko') {
            return $this->unsuccess([], 'Illegal verification');
        }
        return $this->success([]);
    }

    /**
     * return unexpected error
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function returnUnexpectedError(Request $request)
    {
        try {
            $zero = 0;
            $result = 1 / $zero;
            return $this->success($result);
        } catch (\Exception $e) {
            //Output json format using the Exception render function.
            throw new \Exception("something wrong");
        }
    }


    /**
     * Check whether the string is valid.
     * @param Request $request
     * @return string
     */
    public function checkValidString(Request $request)
    {
        $str = $request->input('str');
        $arr = [
            ')' => '(',
            ']' => '[',
            '}' => '{',
        ];
        $count = strlen($str);
        //The number of characters is not even, return incorrect string
        if ($count % 2 != 0) {
            return $this->unsuccess([], 'incorrect string');
        }
        $strack = [];
        for ($i = 0; $i < $count; $i++) {
            //right parenthesis match with left parenthesis in $strack
            if (isset($arr[$str[$i]])) {
                $tmp = array_pop($strack);
                // when not match, return incorrect string
                if ($arr[$str[$i]] != $tmp) {
                    return $this->unsuccess([], 'incorrect string');
                }
            } else {
                //put left parenthesis into $strack
                $strack[] = $str[$i];
            }
        }

        // when $strack is empty ,the string is correct
        if (empty($strack)) {
            return $this->success([], 'correct string');
        } else {
            return $this->unsuccess([], 'incorrect string');
        }
    }
}
