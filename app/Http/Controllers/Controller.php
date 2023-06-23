<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Returns a json response wrapping success message
     *
     * @param array $data 
     * @param int $status 
     * @param string $message 
     *
     * @return JsonResponse
     */
    public function success(mixed $data, int $status = 200, string $message = '') : JsonResponse
    {
        return response()->json([
            'data' => $data,
            'success' => true,
            'message' => $message
        ], $status);
    }

    /**
     * Returns a json response wrapping error message
     *
     * @param int $status 
     * @param string $message 
     *
     * @return JsonResponse
     */
    public function error(int $status = 400, string $message = '') : JsonResponse
    {
        return response()->json([
            'data' => null,
            'success' => false,
            'message' => $message
        ], $status);
    }
}
