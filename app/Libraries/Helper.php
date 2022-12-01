<?php
    use App\Libraries\DotEnv;
    (new DotEnv(BASE_DIR . '/.env'))->load();
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

    if(! function_exists('view')){
        function view($fileName,$data = null){
            if(file_exists("app/Views/$fileName.php")){
                //separate 2d array into variables
                if($data != null)
                    extract($data);
                include "app/Views/$fileName.php";
            }
        }
    }

    if(! function_exists('route')){
        function route($route){
            if($route == "")
                return header("Location: ".getenv('APP_URL'));
            header("Location: $route");
            exit();
        }
    }

    function get($routeName,$class,$function){
        if(PATH == $routeName){
            $class::$function($_GET);
            exit();
        }
        return;
    }

    function post($routeName,$class,$function){
        if(PATH == $routeName){
            $class::$function($_POST);
            exit();
        }
        return;
    }

    function notFound(){
        header("HTTP/1.1 404 Not Found");
        exit("URL not found");
    }

    function esc($string){
        return htmlspecialchars($string);
    }