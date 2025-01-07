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

/**
 * Get All Countries
 */

if(!function_exists('countries')){
    function countries()
    {
        $jsonFile = file_get_contents(base_path('assets/json/countries.json'));
        return json_decode($jsonFile, true);
    }
}

/**
 * Required Sign
 */

if(!function_exists('required_sign')){
    function required_sign()
    {
        return '<span class="text-danger">*</span>';
    }
}

/**
 * Employee Id Generator
 */

if(!function_exists('employee_id')){
    function employee_id()
    {
        return 'EMP-'.date('Ymd').'-'.rand(1000, 9999);
    }
}