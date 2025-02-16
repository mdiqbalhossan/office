<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait DocumentUpload
{
    /**
     * Document Upload Trait
     * @param $query
     * @param $old
     * @return string
     */
    public function documentUploadTrait($query, $old = null, $folder = null, $size): string // Taking input document as parameter
    {
        $ext = strtolower($query->getClientOriginalExtension());

        if ($old !== null) {
            $this->delete($old, $folder);
        }
        $document_name = Str::random(20);
        $document_full_name = $document_name.'.'.$ext;
        $upload_path = 'assets/documents/';   

        if ($folder) {
            $upload_path = 'assets/documents/'.$folder.'/';
        }

        $document_url = $upload_path.$document_full_name;

        if(!is_dir($upload_path)){
            mkdir($upload_path, 0777, true);
        }

        if($folder){
            $folderPath = 'assets/documents/'.$folder .'/';
        }

        $query->move($upload_path, $document_full_name);

        return str_replace($folderPath, '', $document_url); // Just return document
    }

    /**
     * Delete Document
     * @param $path
     * @return void
     */
    protected function delete($path, $folder = null): void
    {
        if (file_exists('assets/documents/'.$path)) {
            @unlink('assets/documents/'.$path);
        }
    }
}