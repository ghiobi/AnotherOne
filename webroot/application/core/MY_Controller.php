<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
* All childs of the app need to extend App_Base_Controller into order check in 
* on the session.
*/
class App_Base_Controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('user_id'))
		{
			redirect(base_url().'login');
		}
	}
}
?>