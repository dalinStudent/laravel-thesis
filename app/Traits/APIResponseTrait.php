<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait APIResponseTrait
{

    public function successWithData($data)
    {
        return response()->json(
            [
                'success' => true,
                'data' => $data 
            ],
            Response::HTTP_OK
        );
    }

    public function success()
    {
        return response()->json(
            [
                'success' => true,
            ],
            Response::HTTP_OK
        );
    }

    public function error($message )
    {
        return response()->json(
            [
                'success' => false,
                'message' => $message,
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
