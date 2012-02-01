<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* User class
*
*/
class User extends CI_Controller {	
	
	/**
	* The class constructor
	*
	*/
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Creates a new user.
	 */
	public function createuser()
	{
		$this->load->model('User_model'); 
		
		$username	= $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$created = date('Y-m-d H:i:s', time());
		$updated = date('Y-m-d H:i:s', time());
		
		$this->User_model->createuser($username, $email, $password, $created, $updated);
	}
	
	/**
	 * Checks to see if login credentials match any users in the
	 * database.
	 */
	public function checkuser()
	{
		$this->load->model('User_model'); 
		
		$username	= $this->input->post('username');
		$password = $this->input->post('password');
		
		$salt = "yoursecretkeyhere";
		$encryptedPassword = crypt($password, $salt);
		$curuser = $this->User_model->getuserbyusername($username);
		if($curuser)
		{
			$passwordFromDatabase = $curuser->password;

			if($passwordFromDatabase == $encryptedPassword)
			{
			  //Login successful
			}
			else
			{
				//Login failed, incorrect password
			}
		}
		else
		{
			//Login failed, user does not exist
		} 
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers