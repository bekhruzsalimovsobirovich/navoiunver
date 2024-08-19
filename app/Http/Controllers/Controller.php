<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param $message
     * @param $result
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($message, $result = [], $code = 200)
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data'    => $result
        ];
        return response()->json($response, $code);
    }

    /**
     * Error response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $result = [], $code = 400): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => false,
            'error'=>true,
            'message' => $message
        ];

        if (!empty($result)) {
            $response['data'] = $result;
        }

        return response()->json($response, $code);
    }

    public function paginate(): \Closure
    {
        return function ($data) {
            $data = [
                'status' => true,
                'data' => $data,
                'message' => 'ok'
            ];

            $data = collect($data)->get('data')->appends(request()->query());
            return response()->json($data);
        };
    }
}
