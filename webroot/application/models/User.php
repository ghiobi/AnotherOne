<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*  Works with the login controller to authenticates users and retrieve user data
*/
class User extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param $login_name
	 * @param $password
	 * @return bool - Returns bool false if failed to authenticate else an object
	 */
	function authenticate($login_name, $password)
	{
		$this->db->select('id, firstname, lastname, password');
		$this->db->from('users');
		$this->db->where('login_name', $login_name);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() == 1 && password_verify($password, $query->row()->password))
		{
			return $query->row();
		}
		return FALSE;
	}

	/**
	 * @param $user_id
	 * @return bool - True if user is an admin
	 */
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

	/**
	 * @param $user_id
	 * @return object - Returns the following variables login_name, firstname, lastname, email
	 */
	function get_user_info($user_id)
	{
		$query = $this->db->query(
		"SELECT
		  users.login_name,
		  users.firstname,
		  users.lastname,
		  users.email
		FROM users
		WHERE users.id = 1 LIMIT 1
		");
		return $query->row();
	}
}
?>