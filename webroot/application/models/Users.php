<?php 
/**
*  The Users class is designed to work with the users database.
*/
class Users extends CI_Model
{
	
	function __construct(argument)
	{
		parent::__construct();
	}

	function login($username, $password)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->where('password', MD5($password));
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1)
			return $query->result();
		else
			return false;
	}

}
?>