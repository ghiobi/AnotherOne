<?php  

session_start();

if(!isset($_SESSION['LOGIN_ID']) && !is_login_page()){
	header('location: '.get_root_url().'/login/');
}

if (isset($_POST['sign-out-btn'])) {
	header('location: '.get_root_url().'/login/');
	session_destroy();
}

?>