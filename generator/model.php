<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class {model_name_1} extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function insert($data = array())
	{
		if($this->db->insert("{table_name}", $data)) return TRUE;
		return FALSE;

	}
	
	public function get(${primary_key})
	{
		$this->db->where("{primary_key}", ${primary_key});
		$query = $this->db->get("{table_name}",1);
		if($query->num_rows() == 1) return $query->row();
		return FALSE;
	}

	public function get_all()
	{
		//$this->db->select("ID");
		$query = $this->db->get("{table_name}");
		if($query->num_rows() > 0) return $query->result();
		return FALSE;
	}
	
	public function update(${primary_key} = NULL, $data = array() )
	{
		$this->db->where("{primary_key}", ${primary_key});
		if($this->db->update("{table_name}", $data)) return TRUE;
		return FALSE;
	}
	
	public function delete(${primary_key} = NULL )
	{
		$this->db->where("{primary_key}", ${primary_key});
		if($this->db->delete("{table_name}")) return TRUE;
		return FALSE;
	}

}

/* End of file {model_name}_model.php */
/* Location: ./app/models/{model_name}.php */