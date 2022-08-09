<?php
class Home extends Controller{

    public function __construct()
    {
        $data = array("header" => "Simple PHP MVC Framework",
                "sub_header" => "Just what you need!");
        $this->view("section/header");
        $this->view("home",$data);
        $this->view("section/footer");
    }

    public static function samplePost($post_data){
        //now you can get values from POST request
    }
    
    public static function sampleGet($get_data){
        //now you can get values from GET request
        //fdsfsd
    }
}
