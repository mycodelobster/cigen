<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class {controller_name_1} extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("{controller_name}_model", "{controller_name}");
	}
	
	public function index()
	{
		$this->listing();
	}
	

	public function listing()
	{
		$this->data["{controller_name}_lists"] = $this->{controller_name}->get_all();
		$this->load->view("{controller_name}/{controller_name}_listing", $this->data);
	}

	public function add()
	{
		$this->form_validation->generate(array("field"));
		if($this->form_validation->run())
		{
			$form_data = array(
				"field" => $this->input->post('field',TRUE)
				);
			$this->{controller_name}->insert($form_data);
			set_success("Succesfully Added");
			redirect(base_url("{controller_name}"));
		}
		$this->load->view("{controller_name}/{controller_name}_add");
	}
	
	public function update(${primary_key} = NULL )
	{
		$this->form_validation->generate(array("field"));
		if($this->form_validation->run())
		{
			$form_data = array(
				"field" => $this->input->post('field',TRUE)
				);
			$this->{controller_name}->update(${primary_key}, $form_data);
			set_success("Succesfully Updated");
			redirect(base_url("{controller_name}"));
		}
		$this->data["{controller_name}"] = $this->{controller_name}->get(${primary_key});
		$this->load->view("{controller_name}/{controller_name}_update", $this->data);
	}
	
	public function delete(${primary_key} = NULL )
	{
		$this->{controller_name}->delete(${primary_key});
		set_success("Succesfully Deleted");
		redirect(base_url("{controller_name}"));
	}

}

/* End of file {controller_name}.php */
/* Location: ./app/controllers/{controller_name}.php */