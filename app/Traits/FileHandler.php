<?php

namespace App\Traits;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;



Trait FileHandler
{
    public static function save_image($image, $path, $extension = 'original'){
        $Image = Image::make($image);
        if($extension != 'original'){
            $Image->encode($extension, 90);
            $imageExtension = $extension;
        }else{
            $imageExtension = $image->getClientOriginalExtension();
        }

        $imageName = uniqid();
        $dist = storage_path('app/public/uploaded_images/');
        $full_path = $dist . $path . '/' . $imageName . '.' . $imageExtension;

        if(!file_exists($dist)){
            mkdir($dist);
        }
        if(!file_exists($dist . $path)){
            mkdir($dist . $path);
        }

        $Image->save($full_path);

        return 'storage/uploaded_images/'.$path.'/'.$imageName.'.'.$imageExtension;
    }

    public static function save_file($file, $path){

        $fileName = uniqid();
        $fileExtension = $file->getClientOriginalExtension();
 

        $dist = storage_path('app/public/uploaded_files/');
        if(!file_exists($dist)){
            mkdir($dist);
        }
        if(!file_exists($dist . $path)){
            mkdir($dist . $path);
        }
       
        $path = 'uploaded_files/'.$path.'/';
        Storage::disk('public')->putFileAs($path, $file, $fileName.'.'.$fileExtension);
        return 'storage/'.$path.$fileName.'.'.$fileExtension;
    }
    
    public static function remove($full_path){
        if(File::exists($full_path)) {
            File::delete($full_path);
          }
    }


    public static function store($request, $name, $inputType, $dataType, $path, $extension = 'original'){

        if($inputType == 'single'){

            if ($request->hasFile($name)){
                if($dataType == 'image'){
                   return FileHandler::save_image($request->$name, $path, $extension);
                }elseif($dataType == 'file'){
                    return FileHandler::save_file($request->$name, $path, $extension);
                }
            }else{
                return null;
            }

        }elseif($inputType == 'multiple'){
            if ($request->has($name)){
                if($dataType == 'image'){
                    $images = [];
                    foreach ($request->$name as $value) {
                        $images[] = FileHandler::save_image($value, $path, $extension);
                    }
                    return json_encode($images);
                }elseif($dataType == 'file'){
                    $files = [];
                    foreach ($request->$name as $value) {
                        $files[] = FileHandler::save_file($value, $path);
                    }
                    return json_encode($files);
                }

            }else{
                return null;
            }
        }

    }


    public static function update($request, $old, $name, $inputType, $dataType, $path, $extension = 'original'){
        if($inputType == 'single'){
            if ($request->has($name)){
                FileHandler::remove($old);

                if($dataType == 'image'){
                    return FileHandler::save_image($request->$name, $path, $extension);
                }elseif($dataType == 'file'){
                    return FileHandler::save_file($request->$name, $path);
                }
            }else{
                $current = $name.'Current';
                if($request->$current == 'delete'){
                    FileHandler::remove($old);
                    return null;
                }else{
                    return $old;
                }
            }

        }elseif($inputType == 'multiple'){
            $result = null;
            if($request->has($name)){
                $files = [];
                if($dataType == 'image'){
                    foreach ($request->$name as $value) {
                        $files[] = FileHandler::save_image($value, $path, $extension);
                    }
                }elseif($dataType == 'file'){
                    foreach ($request->$name as $value) {
                        $files[] = FileHandler::save_file($value, $path);
                    }
                }

                $result = json_encode($files);
            }

            if(!is_null($old)){
                $oldFiles = json_decode($old);
                $current = $name.'Current';
                $afterEdit = json_decode($request->$current);
                foreach ($oldFiles as $value) {
                    if(!in_array($value, $afterEdit)){ FileHandler::remove($value); }
                }
                !is_null($request->$name) ? $afterEdit = array_merge($afterEdit, json_decode($result)) : null;
                return json_encode($afterEdit);
            }else{
                return $result;
            }
        }

    }
}