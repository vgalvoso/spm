<?php
//get request uri
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") .
 	"://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$path = parse_url($url, PHP_URL_PATH);
$path = trim(ltrim(strrchr($path,"/"),"/"));
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