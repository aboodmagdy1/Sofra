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


if (!function_exists('uploadImage')) {

    /**
     * Summary of App\Helpers\uploadImageLocaly
     * @param mixed $image
     * @param mixed $folerName
     * @return string $path of the uploaded image
     */
    function uploadImageLocaly($image)
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images/'), $imageName);
        $path = 'images/' . $imageName;
        return  $path;
    }
}
