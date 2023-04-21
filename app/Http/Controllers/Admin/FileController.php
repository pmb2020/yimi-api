<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;

class FileController extends Controller
{
    public function upload(FileRequest $request)
    {
        $storagePath = 'images/'.date('Y-m').'/'.date('d');
        $filePath= $request->file('file')->store($storagePath);
        return apiResponse(data: [
            'path'=>$filePath,
            'fullPath' => asset($filePath)
        ]);
    }
}
