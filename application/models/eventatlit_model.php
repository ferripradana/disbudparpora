<?php  
/**
* 
*/
class Eventatlit_model extends CI_Model
{
	public $table = 'event_atlit';
    public $id = 'id';
    public $order = 'DESC';
	function __construct()
	{
		parent::__construct();
	}

	function get_all()
	{
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->table)->result();
	}

	function get_by_atlit($id){
		$this->db->order_by($this->id, $this->order);
		$this->db->where('id_atlit', $id);
		return $this->db->get($this->table)->result();	
	}



	function get_by_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
	}

	function total_rows()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function index_limit($limit, $start = 0)
	{
		$this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
	}

	function search_total_rows($keyword = NULL)
	{
		$this->db->like('id', $keyword);
		$this->db->or_like('kecamatanname', $keyword);
		$this->db->from($this->table);
        return $this->db->count_all_results();
	}

	function search_index_limit()
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->or_like('name', $keyword);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
	}

	function insert($data)
	{
		$this->db->insert($this->table, $data);
		 return $this->db->insert_id();
	}

	 function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);

    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function deletebyatlit($id_atlit)
    {
        $this->db->where($this->id_atlit, $id_atlit);
        $this->db->delete($this->table);
    }

}
?>