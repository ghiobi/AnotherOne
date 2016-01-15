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

	function authenticate($login_name, $password)
	{
		$this->db->select('id, firstname, lastname');
		$this->db->from('users');
		$this->db->where('login_name', $login_name);
		$this->db->where('password', MD5($password));
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		return FALSE;
	}

	function is_admin($user_id)
	{
		$query = $this->db->query(
			"SELECT
			  COUNT(admins.id) AS is_admin
			FROM users
			  INNER JOIN admins
			    ON users.id = admins.user_id
			WHERE users.id = '$user_id'");
		return $query->row()->is_admin == 1;
	}

}
?>