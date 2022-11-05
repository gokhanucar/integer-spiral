<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    protected function successResponse($data, $code, $message = "")
    {
        return response()->json(array_merge([
            'status' => $code,
            'error' => false,
            'message' => $message
        ], $data), $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json([
            'status' => $code,
            'error' => true,
            'message' => $message,
        ], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        return $this->successResponse(['data' => $collection], $code);
    }

    protected function showOne(Model $model, $code = 200)
    {
        return $this->successResponse(['data' => $model], $code);
    }

    protected function showArray(array $model, $code = 200)
    {
        return $this->successResponse(['data' => $model], $code);
    }
}
