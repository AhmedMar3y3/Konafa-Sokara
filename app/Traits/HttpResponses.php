<?php

namespace App\Traits;

trait HttpResponses
{
    public function successResponse($data = null, $message = 'Success', $statusCode = 200, $key = 'success')
    {
        $response = [
            'key' => $key,
            'message' => $message,
            'data' => $data,
        ];

        if ($data instanceof \App\Http\Resources\UserResource) {
            $user = $data->resource;

            if (!$user->is_active) {
                $response['key'] = 'ActivationNeeded';
            } elseif (!$user->completed_info) {
                $response['key'] = 'CompletionNeeded';
            }
        }


        return response()->json($response, $statusCode);
    }

    public function failureResponse($message = 'Failure', $statusCode = 400)
    {
        return response()->json([
            'key' => 'failed',
            'message' => $message,
        ], $statusCode);
    }
}