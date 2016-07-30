<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Saranaolahraga_model extends CI_Model
{

    public $table = 'saranaolahraga';
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
         if ($this->session->userdata('kecamatan')!=27) {
             $this->db->where('kecamatan',$this->session->userdata('kecamatan'));
        }
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
         if ($this->session->userdata('kecamatan')!=27) {
             $this->db->where('kecamatan',$this->session->userdata('kecamatan'));
        }
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows() {
        $this->db->from($this->table);
         if ($this->session->userdata('kecamatan')!=27) {
             $this->db->where('kecamatan',$this->session->userdata('kecamatan'));
        }
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->order_by('s.'.$this->id, $this->order);
        $this->db->limit($limit, $start);
         if ($this->session->userdata('kecamatan')!=27) {
             $this->db->where('kecamatan',$this->session->userdata('kecamatan'));
        }
        $return = $this->db->select('s.*, k.kecamatanname as kecamatan')
                            ->from('saranaolahraga s')
                            ->join('kecamatan k','s.kecamatan=k.id')
                            ->get()
                            ->result();
        return $return;
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {
	$this->db->like('name', $keyword);
	$this->db->or_like('alamat', $keyword);
	$this->db->or_like('k.kecamatanname', $keyword);
	$this->db->or_like('kapasitas', $keyword);
     if ($this->session->userdata('kecamatan')!=27) {
             $this->db->where('kecamatan',$this->session->userdata('kecamatan'));
        }
	$this->db->select('s.*, k.kecamatanname as kecamatan')
                            ->from('saranaolahraga s')
                            ->join('kecamatan k','s.kecamatan=k.id');
    return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
	$this->db->like('name', $keyword);
	$this->db->or_like('alamat', $keyword);
	$this->db->or_like('k.kecamatanname', $keyword);
	$this->db->or_like('kapasitas', $keyword);
	$this->db->limit($limit, $start);
     if ($this->session->userdata('kecamatan')!=27) {
             $this->db->where('kecamatan',$this->session->userdata('kecamatan'));
        }
        $this->db->order_by('s.'.$this->id, $this->order);
        $this->db->limit($limit, $start);
        $return = $this->db->select('s.*, k.kecamatanname as kecamatan')
                            ->from('saranaolahraga s')
                            ->join('kecamatan k','s.kecamatan=k.id')
                            ->get()
                            ->result();
        return $return;
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

}

/* End of file saranaolahraga_model.php */
/* Location: ./application/models/saranaolahraga_model.php */