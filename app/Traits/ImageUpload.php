<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ImageUpload
{
    /**
     * Image Upload Trait
     * @param $query
     * @param $old
     * @return string
     */
    public function imageUploadTrait($query, $old = null, $folder = null, $size): string // Taking input image as parameter
    {
        $ext = strtolower($query->getClientOriginalExtension());

        if ($old !== null) {
            $this->delete($old, $folder);
        }
        $image_name = Str::random(20);
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'assets/images/';   

        if ($folder) {
            $upload_path = 'assets/images/'.$folder.'/';
        }

        $image_url = $upload_path.$image_full_name;

        if(!is_dir($upload_path)){
            mkdir($upload_path, 0777, true);
        }

        if($folder){
            $folderPath = 'assets/images/'.$folder .'/';
        }

        $query->move($upload_path, $image_full_name);

        return str_replace($folderPath, '', $image_url); // Just return image
    }

    /**
     * Delete Image
     * @param $path
     * @return void
     */
    protected function delete($path, $folder = null): void
    {
        if (file_exists('assets/images/'.$path)) {
            @unlink('assets/images/'.$path);
        }
    }
}