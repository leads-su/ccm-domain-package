<?php

if (!function_exists('respond')) {

    function respond(callable $callback, string|null $message = null, int|null $status = \Illuminate\Http\Response::HTTP_OK): \Illuminate\Http\JsonResponse {
        try {
            if (!$message) {
                $message = 'Successfully retrieve data from server';
            }
            return response_success($callback(), $message, $status);
        } catch (Exception $exception) {

            return response_error($exception, 'Failed to retrieve data from server', \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}

if (!function_exists('response_success')) {

    function response_success(mixed $data, string|null $message = null, int $status = \Illuminate\Http\Response::HTTP_OK): \Illuminate\Http\JsonResponse {
        if (!$message) {
            $message = 'Successfully retrieve data from server';
        }

        if ($data instanceof \Illuminate\Contracts\Support\Arrayable) {
            $data = $data->toArray();
        }

        return response()->json([
            'success'       =>  true,
            'code'          =>  $status,
            'data'          =>  $data,
            'message'       =>  $message,
        ], $status);
    }

}

if (!function_exists('response_error')) {

    function response_error(mixed $data, string|null $message = null, int $status = \Illuminate\Http\Response::HTTP_NOT_FOUND): \Illuminate\Http\JsonResponse {
        if (!$message) {
            $message = 'Failed to retrieve data from server';
        }

        if ($data instanceof Exception) {
            $message = $data->getMessage();
            $data = [
                'code'      =>  $data->getCode(),
                'message'   =>  $data->getMessage()
            ];
            $status = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return response()->json([
            'success'       =>  false,
            'code'          =>  $status,
            'data'          =>  $data,
            'message'       =>  $message,
        ], $status);
    }

}
