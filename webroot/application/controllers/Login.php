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
		if($this->session->userdata('user_id'))
		{
			session_destroy();
		}

		$data['title'] = 'Login';

		$this->load->view('layouts/header.php', $data);
		$this->load->view('login/index.php');
		$this->load->view('layouts/footer.php');
	}

	function login()
	{
		$this->load->model('user_model');

		$login_id = $this->input->post('login_id');
		$password = $this->input->post('password');
		
		$this->form_validation->set_rules('login_id', 'Login ID', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');


		if($this->form_validation->run() === FALSE)
		{
			$this->index();
			return;
		}

		$result = $this->user_model->authenticate($login_id, $password);

		if($result === FALSE)
		{
			$this->index();
			return;
		}

		$this->session->set_userdata('user_id', $result->id);
		redirect(base_url());
	} 
}
?>