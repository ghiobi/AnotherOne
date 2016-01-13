<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*  Works with the login controller, and authenticates users.
*/
class User extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function authenticate($login_id, $password)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('login_id', $login_id);
		$this->db->where('password', MD5($password));
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		return FALSE;
	}

	function get_full_name($user_id)
	{
		$query = $this->db->query("SELECT * FROM users WHERE id='$user_id'");
		$row = $query->row();
		return $row->firstname.' '.$row->lastname;
	}

	function is_administrator($user_id)
	{
		$this->db->where('name', $user_id);
		return $this->db->query("SELECT * FROM users WHERE id='$user_id'")->row()->admin == 1;
	}

}
?>