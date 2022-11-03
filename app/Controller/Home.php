<?php
namespace App\Controller;

class Home{

    public static function index()
    {
        $data = array("header" => "Simple PHP MVC Framework",
                "sub_header" => "Just what you need!");
        view("section/header");
        view("home",$data);
        view("section/footer");
    }

    public static function samplePost($postData){
        //now you can get values from POST request
        extract($postData);
    }
    
    public static function sampleGet($getData){
        //now you can get values from GET request
        extract($getData);
    }
}
