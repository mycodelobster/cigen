<?php 
/**
* 
*/				
class MY_Session extends CI_Session
{
	public function auth()
	{
		$CI =& get_instance();
		return $CI->session->userdata("user_session");
	}

	public function uid()
	{
		$CI =& get_instance();
		return $CI->session->userdata("user_session")->user_id;
	}

	public function is_logged()
	{
		$CI =& get_instance();
		if($CI->session->userdata("user_session"))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
?>