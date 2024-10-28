<?php

namespace App\Helpers;

if (!function_exists('responseJson')) {
    function responseJson($status, $message, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response);
    }
}
