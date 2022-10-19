<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ApiRespons
{
    public function responseData($message = "", $data = [], $code = 200, $meta = [])
    {
        return response(array_merge([
            'success' => in_array($code, [200, 201, 202]),
            'data' => $data,
            'message' => $message,
        ], $meta), $code);
    }
}
