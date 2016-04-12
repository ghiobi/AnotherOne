<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*  Works with the login controller to authenticates users and retrieve user data.
*/
class User extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Authenticates the user upon signing in. Returns the firstname, lastname, hash
	 *
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

		//Verifies if there was one user and checks with password_verify (provided by PHP)
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
	 * Returns the user's information.
	 *
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

	/**
	 * Updates the password
	 *
	 * @param $old_password
	 * @param $new_password
	 * @return bool - returns true if attempt was successful
	 */
	function update_password($old_password, $new_password)
	{
		$user_id = $this->session->userdata('user_id');

		$password_hash = $this->db->query("
			SELECT
			  users.password
			FROM users
			WHERE users.id = '$user_id'")->row()->password;

		//If the old password is incorrect return false.
		if(!password_verify($old_password, $password_hash)){
			return FALSE;
		}

		//Generates the new password with the blowfish hashing algorithm.
		$new_password_hash = password_hash($new_password, CRYPT_BLOWFISH);

		$this->db->query(
			"UPDATE users
				SET password = '$new_password_hash'
			WHERE id = '$user_id'");

		return TRUE;
	}
}
