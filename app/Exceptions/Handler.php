<?php

namespace App\Exceptions;

use App\Models\ExceptionInfo;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    /**
     * rewrite render function, if an exception occurs, return json format
     * @param $request
     * @param Throwable $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $e)
    {

        $this->writeLog($e); //write log into mysql.

        // handle http exception like 404 not found
        //requirement 4-c
        if ($e instanceof HttpException) {
            return response()->json([
                'code' => $e->getCode(),
                'data' => [],
                'msg' => $e->getMessage(),
            ]);
        }

        //requirement 4-a
        if (env('APP_DEBUG')) {
            return response()->json([
                'code' => $e->getCode(),
                'data' => [],
                'msg' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);
        } else { //requirement 4-b
            return response()->json([
                'code' => HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
                'data' => [],
                'msg' => 'Internal Server error',
            ]);
        }

    }

    /**
     * write log into mysql.
     * @param $request
     * @param $response_data
     * @return void
     */
    private function writeLog($e)
    {
        $arr = [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace_str' => $e->getTraceAsString()
        ];
        ExceptionInfo::create($arr);
        return;
    }
}
