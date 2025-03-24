<?php

namespace App\helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageManager
{
    public static function upload(string $dir, $image = null)
    {
        if ($image != null) {
            $extension = $image->getClientOriginalExtension();
            if (empty($extension)) {
                $extension = 'png';
            }
            $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $extension;
            $image->move(public_path($dir), $imageName);
            return $imageName;
        }
        return null;
    }
    
    public static function append(string $dir, $old_images, $images = null)
    {
        $existingImages = is_array($old_images) ? $old_images : [];
    
        $newImageNames = [];
        if ($images) {
            $imageFiles = is_array($images) ? $images : [$images];
    
            foreach ($imageFiles as $image) {
                $imageName = self::upload($dir, $image);
                if ($imageName) {
                    $newImageNames[] = $imageName;
                }
            }
        }
    
        return array_merge($existingImages, $newImageNames);
    }
    public static function update(string $dir, $old_image, $image = null)
    {
        // dd($old_image);
        if ($old_image) {
            $old_image_name = str_replace(asset($dir), '', $old_image);
            if (file_exists($dir . '/' . $old_image_name)) {
                unlink($dir . '/' . $old_image_name);
            }
        }

        $imageName = ImageManager::upload($dir, $image);
        return $imageName;
    }


    public static function move_image($from_full_path, $to_path, $file)
    {
        $file = collect(explode('/', $file))->last();
        if (!Storage::disk('public')->exists($to_path)) {
            Storage::disk('public')->makeDirectory($to_path);
        }
        if (Storage::disk('public')->exists($from_full_path)) {
            try {
                Storage::disk('public')->copy($from_full_path, $to_path . $file);
                return $file;
            } catch (\Throwable $th) {
                return $file;
            }
        }
        return 'def.png';
    }

    public static function upload_temp($image)
    {
        // dd($image);
        if ($image) {
            try {
                $file = ImageManager::upload('uploads/temp/', $image);
                return [
                    'status' => 1,
                    'file' => $file,
                    // 'url' => asset('uploads/temp/' . $file),
                ];
                // return $file;
            } catch (\Throwable $th) {
                return [
                    'status' => 0,
                    'message' => $th->getMessage(),
                ];
            }
        }
        return [
            'status' => 0,
            'msg' => __('File not found'),
        ];
    }

    public static function delete($full_path)
    {
        // if (Storage::disk('public')->exists($full_path)) {
        //     Storage::disk('public')->delete($full_path);
        // }
        // $old_image_name = str_replace(asset($dir), '', $old_image);
        // dd($full_path);
        if (file_exists($full_path)) {
            unlink($full_path);
        }

        // return [
        //     'success' => 1,
        //     'message' => translate('Removed successfully !')
        // ];

    }

    public static function upload_image(string $dir, string $format, $image = null)
    {
        if ($image) {
            $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
        } else {
            $imageName = 'def.png';
        }

        return $imageName;
    }
}
