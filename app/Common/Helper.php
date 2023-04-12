<?php

function apiResponse($code = 0, $msg = 'success', $data = []){
    return response()->json([
        'code' => $code,
        'msg' => $msg,
        'data' => $data
    ]);
}

function apiResponseError($arr,$data = []){
    return response()->json([
        'code' => $arr[0],
        'msg' => $arr[1],
        'data' => $data
    ]);
}
