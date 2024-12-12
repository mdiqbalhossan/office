<?php


/**
 * Status Show
 */

if(!function_exists('status')){
    function status($status)
    {
        if($status){
            return '<span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">Active</span>';
        }else{
            return '<span class="bg-danger-focus text-danger-main px-32 py-4 rounded-pill fw-medium text-sm">Deactivate</span>';
        }
    }
}

/**
 * Safe Function
 */

 if(!function_exists('safe')){
    function safe($content){
        if(!empty($content)){
            return $content;
        }
        return 'N/A';
    }
 }