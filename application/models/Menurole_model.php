<?php  
	/**
	* 
	*/
	class Menurole_model extends CI_Model
	{
		public $table = 'menu_role';

		function insert($data)
		{
			$this->db->insert($this->table, $data);
		}
		function delete($id)
		{
			$this->db->where('menuRole', $id);
			$this->db->delete($this->table);
		}
	}
?>