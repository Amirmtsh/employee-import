<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class UploadHelper
{
    public static function store($file, $path)
    {
        $filePath = Storage::disk('local')->putFileAs(
            $path,
            $file,
            $file->getClientOriginalName()
        );

        return $filePath;
    }
}