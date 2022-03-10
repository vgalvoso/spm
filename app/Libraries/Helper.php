<?php
class Helper{
    /**
     * Generate output in JSON format and terminate the script
     *
     * @param string|array $message value to
     * 
     * @author Van
     * 
     * @return string JSON encoded string
     */ 
    public static function output($message){
        exit(json_encode($message));  
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
    public static function assocToIndexed($array){
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
    public static function extractAssocArray($value){
        $val = array_values($value);
        return $val[0];
    }

    public static function download($fileName,$html,$extension){
        // Headers for download 
        header("Content-Type: application/$extension"); 
        header("Content-Disposition: attachment; filename=$fileName.$extension"); 

        echo $html;
    }
}
