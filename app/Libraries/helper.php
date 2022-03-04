<?php

$date = Date("Y-m-d");
$year = Date("Y");

//error handler function
function errorHandler($errno, $errstr) {
    header("Location:error?message=$errstr");
}
  
//set error handler
//set_error_handler("errorHandler");

/**
 * Generate output in JSON format and terminate the script
 *
 * @param string|array $message value to
 * 
 * @author Van
 * 
 * @return string JSON encoded string
 */ 
function output($message){
    echo json_encode($message);
    exit(0);  
}

/**
 * Convert associative array into indexed array
 * 
 * @param array $array associative array
 * 
 * @author Van
 * 
 * @return array indexed array
 */ 
function assocToIndexed($array){
    return array_map('extractAssocArray', $array);
}

/**
 * Extract value of an associative array
 * - mainly used as callback
 * 
 * @param array $value single item associative array
 * 
 * @author Van
 * 
 * @return mixed value of associative array
 */ 
function extractAssocArray($value){
    $val = array_values($value);
    return $val[0];
}

function download($fileName,$html,$extension){
    // Headers for download 
    header("Content-Type: application/$extension"); 
    header("Content-Disposition: attachment; filename=$fileName.$extension"); 

    echo $html;
}