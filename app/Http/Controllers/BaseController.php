<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{

    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    public function uploadFile($request_file)
    {
        return Storage::disk("public")->put("uploads", $request_file);
    }
}
