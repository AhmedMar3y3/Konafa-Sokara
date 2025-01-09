<?php

namespace App\Traits;

trait HttpResponses
{

    public function response($key,$message,$data = '',$statusCode){

        return response()->json([
            'key' => $key,
            'msg' => $message,
            'data' => $data
        ], $statusCode);
    }


    public function successResponse($key,$message,$data, $statusCode = 200,)
    {
        // $response = [
        //     'key' => $key,
        //     'message' => $message,
        //     'data' => $data,
        // ];

        // if ($data instanceof \App\Http\Resources\UserResource) {
        //     $user = $data->resource;

        //     if (!$user->is_active) {
        //         $response['key'] = 'ActivationNeeded';
        //     } elseif (!$user->completed_info) {
        //         $response['key'] = 'CompletionNeeded';
        //     }
        // }


        return $this->response('success', $message = 'تم الارسال بنجاح', $data, 200);
    }

    public function successWithDataResponse($data){
        return $this->response('success', $message = 'تم الارسال بنجاح', $data, 200);
    }

    public function failureResponse($message = 'Failure', $statusCode = 400)
    {
        return $this->response('failure', $message, '', $statusCode);
    }
}