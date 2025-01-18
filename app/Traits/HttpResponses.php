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


    public function successResponse($message = 'تم بنجاح')
    {
        return $this->response('success', $message, $data = '', 200);
    }

    public function successWithDataResponse($data){
        return $this->response('success', $message = 'تم بنجاح', $data, 200);
    }
    public function inactiveUserResponse($data)
    {
        return $this->response('ActivationNeeded', $message = 'يرجي تأكيد الحساب', $data, $statusCode = 200);
    }
    public function incompletedUserResponse($data)
    {
        return $this->response('CompletetionNeeded', $message = 'يرجي إكمال البيانات', $data, $statusCode = 200);
    }

    public function unauthenticatedResponse(){
        return $this->response('unauthenticated', $message = 'غير مصرح', $data = '', $statusCode = 400);
    }

    public function failureResponse($message = 'Failure', $statusCode = 400)
    {
        return $this->response('failure', $message, '', $statusCode);
    }
}