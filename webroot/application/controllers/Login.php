<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
* Controls Login Process
*/
class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Displays the login page.
	 */
	public function index()
	{
		//Redirects user to homepage if logged in
		if($this->session->userdata('user_id'))
		{
			redirect(base_url());
		}

		//Validates login if sign in button was submitted/pressed
		if($this->input->post('signin_btn'))
		{
			$this->load->model('user');

			//Extracting post data from input forms
			$login_name = $this->input->post('login_name', TRUE); //Enabled XSS Filtering
			$password = $this->input->post('password', TRUE);
			
			//Validating and cleaning data
			$this->form_validation->set_rules('login_name', 'Login ID', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			//Checking for empty input forms
			if($this->form_validation->run() === FALSE)
			{
				goto view;
			}

			//Checking with database if valid user
			$result = $this->user->authenticate($login_name, $password);

			if($result === FALSE)
			{
				$data['invalid_record'] = 'Did not match any records. Try again';
				goto view;
			}

			//Sets the following data to session cookies
			$this->session->set_userdata('user_id', $result->id);
			$this->session->set_userdata('firstname', $result->firstname);
			$this->session->set_userdata('lastname', $result->lastname);
			
			//Redirects user to home page if everything is successful
			redirect(base_url());
			return;
		}

		view:

		$data['awesome'] = null;
		$this->load->view('login/index.php', $data);
	}

	/**
	 *  Destroys session upon signout, and redirects the user to the main page.
	 */
	public function signout()
	{
		session_destroy();
		redirect(base_url().'login', 'refresh');
	}
}
?>