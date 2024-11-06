<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

if (!function_exists('serviceResponse')) {
    function serviceResponse($status, $message, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return $response;
    }
}

if (!function_exists('responseJson')) {
    function responseJson($status, $message, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return $response;
    }
}

if (!function_exists('settings')) {
    function settings()
    {
        $settings = Setting::find(1);
        if ($settings) {
            return $settings;
        }
        return new Setting();
    }
}


if (!function_exists('uploadImage')) {

    /**
     * Summary of App\Helpers\uploadImage
     * @param string $disk
     * @param string $path
     * @param mixed $image
     * @return string $path of the uploaded image
     */
    function uploadImage($image, $paht, $disk = 'public')
    {
        $paht = Storage::disk($disk)->putFileAs(
            $paht,
            $image,
            str()->uuid() . '.' . $image->extension()
        );

        return $paht;
    }
}


if (!function_exists('deleteImage')) {

    /**
     * Summary of App\Helpers\deleteImage
     * @param mixed $path
     * @return void 
     */
    function deleteImage($path, $disk = 'public')
    {
        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }
}
