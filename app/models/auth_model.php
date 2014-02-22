<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {
	

	public function __construct(){
		parent::__construct();
	}


	
	public function login($username,$password)
	{
		$this->db->where('username',$username);
		$this->db->where('password',md5($password));
		$query = $this->db->get('users',1);
		if($query->num_rows()==1)
		{
			$this->session->set_userdata('user_session',$query->row());
			
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	
	public function signup($username,$password,$email)
	{
		$params = array(
			'username' => $username,
			'password' => md5($password),
			'email' => $email
			);
		$query = $this->db->insert('users',$params);
		if($query)
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	public function logout()
	{
		$this->session->set_userdata('user_sesion',FALSE);
		$this->session->sess_destroy();
	}

	public function forgot()
	{
		
	}

}

/* End of file auth_model.php */
/* Location: ./app/models/auth_model.php */
