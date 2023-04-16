<?php

use Illuminate\Http\JsonResponse;

function apiResponse($code = 0, $msg = 'success', $data = []): JsonResponse
{
    return response()->json([
        'code' => $code,
        'msg' => $msg,
        'data' => $data
    ]);
}

function apiResponseError($arr,$data = []): JsonResponse
{
    return response()->json([
        'code' => $arr[0],
        'msg' => $arr[1],
        'data' => $data
    ]);
}
