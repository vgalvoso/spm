<?php
class Controller{

    public function view($fileName,$data = null){
        if(file_exists("app/Views/$fileName.php")){
            //separate 2d array into variables
            if($data != null)
                extract($data);
            include "app/Views/$fileName.php";
        }
    }

    public static function export($data,$filename){
        // Headers for download 
        header("Content-Type: application/xls"); 
        header("Content-Disposition: attachment; filename=$filename"); 
    
        echo $data;
    }
}