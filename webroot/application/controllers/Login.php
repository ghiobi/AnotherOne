<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
* 
*/
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data['title'] = 'Login';

		$this->load->view('layouts/header.php', $data);
		$this->load->view('login/index.php');
		$this->load->view('layouts/footer.php');
	}

	function login(){
	}
}
?>