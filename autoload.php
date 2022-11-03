<?php
$path = $_SERVER['REQUEST_URI'];
//get $path except first "/"
$path = substr($path, 1);
//remove string from start to second "/"
$path = substr($path, strpos($path, "/") + 1);
define('PATH',$path);
define('BASE_DIR',__DIR__);
spl_autoload_register(function($className) {
    $file = $className . '.php';
	if (file_exists($file)) {
		include $file;
	}
	$file = "app/Controller/".$className . '.php';
	if (file_exists($file)) {
		include $file;
	}
	
	$file = "app/Libraries/".$className . '.php';
	if (file_exists($file)) {
		include $file;
	}

	$file = "app/Model/".$className . '.php';
	if (file_exists($file)) {
		include $file;
	}
});