<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kecamatan_model extends CI_Model
{

    public $table = 'kecamatan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {
	$this->db->like('kecamatanname', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
	$this->db->or_like('kecamatanname', $keyword);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
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
    function get_all_array()
    {
        $return = array();
        $this->db->order_by('kecamatanname','asc');
        if ($this->session->userdata('kecamatan')!=27) {
             $this->db->where('id',$this->session->userdata('kecamatan'));
        }    


        $res =  $this->db->get($this->table)->result();


      
        foreach ($res as $key => $value) {
            $return[$value->id] = $value->kecamatanname;
        }
        return $return;
    }
    

}

/* End of file kecamatan_model.php */
/* Location: ./application/models/kecamatan_model.php */