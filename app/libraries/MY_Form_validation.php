<?php

/**
* Form Validation Edit Uniqe
* http://forrst.com/posts/Validating_Uniqueness_In_CodeIgniter_When_Updati-DDA
**/
class MY_Form_validation extends CI_Form_validation{

	function __construct($config = array()){
		parent::__construct($config);
		$this->_error_prefix = '<div class="alert alert-error">';
		$this->_error_suffix = '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
	}

	function generate($input){
		$CI =& get_instance();
		foreach ($input as  $name) {
			$CI->form_validation->set_rules($name,ucfirst($name),'trim|required|xss_clean');
		}
		return $CI;
	}

	function edit_unique($value, $params){
		$CI =& get_instance();
		$CI->load->database();

		$CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");

		list($table, $field, $current_id) = explode(".", $params);

		$query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();

		if($query->row() && $query->row()->id != $current_id){
			return FALSE;
		}
	}


	function edit_unique_cat($value, $params){
		$CI =& get_instance();
		$CI->load->database();

		$CI->form_validation->set_message('edit_unique_cat', "Sorry, that %s is already being used.");

		list($table, $field, $current_id) = explode(".", $params);

		$query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();

		if($query->row() && $query->row()->cat_id != $current_id){
			return FALSE;
		}
	}


	function alpha_space($str_in = ''){
		$CI =& get_instance();
		if(! preg_match("/^([a-z ])+$/i", $str_in)){
			$CI->form_validation->set_message('alpha_space', '%s may only contain alpha characters.');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

	function alpha_space_dash($str_in = ''){
		$CI =& get_instance();
		if(! preg_match("/^([-a-z0-9_ ])+$/i", $str_in)){
			$CI->form_validation->set_message('alpha_space_dash', '%s may only contain alpha characters.');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	public function error_array(){
		// http://stackoverflow.com/questions/4676915/form-validation-errors-into-array
		$error = $this->_error_array;
		if($error){
			foreach($error as $key => $value){
				$result[] = $value;
			}
			return $result[0];
		}
		return FALSE;
	}
}

?>
