<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model','auth');
	}
	
	public function index()
	{
		$this->login();
	}

	public function login()
	{

		$this->form_validation->generate(array('username','password'));
		if($this->form_validation->run()==TRUE)	
		{
			$username = $this->input->post('username',TRUE);
			$password = $this->input->post('password',TRUE);
			if($this->auth->login($username, $password)) 
			{
				redirect(base_url('dashboard'));
			}
			else
			{
				set_error('Login Failed');
				redirect(base_url('login'));
			}
		}
		$this->load->view('login_view');	
	}

	public function signup()
	{

		$this->form_validation->generate(array('username','password','email'));
		if($this->form_validation->run()==TRUE)
		{
			$username = $this->input->post('username',TRUE);
			$password = $this->input->post('password',TRUE);
			$email = $this->input->post('email',TRUE);
			if($this->auth->signup($username, $password, $email))
			{
				set_success('Success');
				redirect(base_url('login'));
			}
			else
			{
				set_error('Signup Failed');
				redirect(base_url('signup'));
			}
		}
		$this->load->view('signup_view');
	}

	public function logout()
	{
		$this->auth->logout();
		redirect(base_url());
	}

	public function forgot()
	{
		
	}

}

/* End of file auth.php */
/* Location: ./app/controllers/auth.php */
