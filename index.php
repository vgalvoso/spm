<?php
include "autoload.php";
if($path != ""){
    switch($path){
        case "home":
            new Home();
            break;
        default:
            echo "<h1> Page not found </h1>";
        break;
    }
}else{
    new Home();
}