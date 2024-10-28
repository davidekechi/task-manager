<?php

spl_autoload_register('autoLoader');

// Create function to automatically load in class script depending on classname
function autoLoader($className) {

	// Replace class namespace divider with directory separator
	$className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

	$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	$path = strpos($url, 'routes') ? '../app/' : 'app/';
	$ext = '.php';
	$filePath = $path . $className . $ext;

	// Handle error
	if(!file_exists($filePath)) {
		echo 'false';
		echo $filePath;
		return false;
	}

	include_once $filePath;
}

// Base class to be extended to
include __DIR__ .'/../app/Models/Task.php';