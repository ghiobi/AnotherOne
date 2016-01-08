<?php

function is_login_page(){
	return basename(get_current_url()) === 'login';
}

function get_resource_url(){
	return get_root_url().'/resources';
}

function get_current_url(){
	$url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
	$url .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	return $url;
}

function get_root_url(){
	if(!defined('ABSPATH')){
		$url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
		$url .= $_SERVER['SERVER_NAME'];
		$path = substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT']));
		if(strlen($path) != 0)
			$url .= '/'.str_replace('\\', '/', $path);
		define('ABSPATH', $url);
	}
	return ABSPATH;
}

?>