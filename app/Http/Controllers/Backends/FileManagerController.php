<?php

namespace App\Http\Controllers\Backends;

use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Http\Controllers\Controller;

class FileManagerController extends Controller
{
    public function saveTempFile()
    {
        $temp_files = [];
        $files = request('image') ?? request('images') ?? request('files');
        if (!is_array($files)) {
            $files = [$files];
        }
        foreach ($files as $key => $file) {
            // $temp_files[] = asset('uploads/temp/' . ImageManager::upload_temp($image));
            $temp = ImageManager::upload_temp($file);
            if ($temp['status'] == 0) {
                return response()->json([
                    'status' => 0,
                    'msg' => __('Something went wrong')
                ]);
            }

            $temp_files[] = $temp['file'];
        }
        return response()->json([
            'status' => 1,
            'temp_files' => $temp_files,
        ]);
    }

    public function removeTempFile()
    {
        dd(request('image_name'));
    }
}
