<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

Trait ImageService
{
    public function storeImage($file,$filePath,$width,$height,$module='image') : string
    {
        $path = public_path($filePath);
        if (!file_exists($path) ) {
            mkdir($path, 0777, true);
        }
        $fileNameToStore = $module.'-'.date('Ymdhis').rand(0,999).".".$file->getClientOriginalExtension();
        $success = $file->move($path, $fileNameToStore);
        if($success){
            if(!in_array($file->getClientOriginalExtension(),['pdf','doc','docx','ppt','txt','xls'])){
                Image::make($path."/". $fileNameToStore)->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path.'/Thumb-'.$fileNameToStore);
            }

        }
        return $fileNameToStore;
    }

    public function removeImage($filePath,$fileName)
    {
        if(File::exists(public_path($filePath.$fileName))){
            File::delete(public_path($filePath.$fileName));
        }

        //thumb image
        if(File::exists(public_path($filePath.'/Thumb-'.$fileName))){
            File::delete(public_path($filePath.'/Thumb-'.$fileName));
        }

    }

}
