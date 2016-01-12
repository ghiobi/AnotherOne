<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*  The Users class is designed to work with the users database.
*/
class User_model extends CI_Model
{

	private $first_name;
	private $last_name;
	private $admin = FALSE;
	
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

	function getFullName($user_id)
	{
		$query = $this->db->query("SELECT * FROM users WHERE id='$user_id'");
		$row = $query->row();
		return $row->firstname.' '.$row->lastname;
	}

}
?>