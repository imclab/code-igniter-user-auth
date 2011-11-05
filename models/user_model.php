<?php

/**
* User model class
*
*/
class User_model extends CI_Model
{
	
	var $username	= '';
	var $email = '';
	var $password	= '';
	var $created = '';
	var $updated = '';
	
	/**
	* The class constructor
	*
	*/
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	* Creates a new User.
	* 
	* @param string $username
	* @param string $email
	* @param string $password
	* @param string $created
	* @param string $updated
	*/
	function createuser($username, $email, $password, $created, $updated)
	{
		$this->username	= $username;
		$this->email = $email;
		$salt = 'yoursecretkeyhere';
		$encryptedPassword = crypt($password, $salt);
		$this->password = $encryptedPassword;
		$this->created = $created;
		$this->updated = $updated;

		$this->db->insert('users', $this);
	}
	
	/**
	* Retrieves a user by username.
	*
	* @param string $username
	* @return object an object containing the user row from the database
	*/
	function getuserbyusername($username)
	{
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row();
	}
	
}