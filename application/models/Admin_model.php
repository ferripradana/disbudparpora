<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public $table = 'admin';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    //arka
    // get all
    function get_all()//fungsi untuk memangil semua data admin dari kampus
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)//mencari data berdasarkan
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows() {//mencari jumlah semua data yang ada di database
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {//mencacah data di database sesuai batas paginasi
        $this->db->order_by('ad.'.$this->id, $this->order);
        $this->db->limit($limit, $start);
        $return = $this->db->select('ad.*, k.kecamatanname as kecamatan, r.roleName as role')
                            ->from('admin ad')
                            ->join('kecamatan k','ad.kecamatan=k.id')
                            ->join('role r','ad.role=r.roleId')
                            ->get()
                            ->result();
        return $return;
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {//mencari jumlah dari pencarian 
    $this->db->like('username', $keyword);
	$this->db->or_like('email', $keyword);
    $this->db->or_like('k.kecamatanname', $keyword);
    $this->db->or_like('r.roleName', $keyword);
	$this->db->or_like('password', $keyword);
    $this->db->select('ad.*, k.kecamatanname as kecamatan, r.roleName as role')
                            ->from('admin ad')
                            ->join('kecamatan k','ad.kecamatan=k.id')
                            ->join('role r','ad.role=r.roleId');
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {//mencacah data sesuai batas paginasi sesuai kunci pencarian
        $this->db->order_by($this->id, $this->order);
        $this->db->like('username', $keyword);                 
	    $this->db->or_like('email', $keyword);
        $this->db->or_like('k.kecamatanname', $keyword);
        $this->db->or_like('r.roleName', $keyword);
	    $this->db->limit($limit, $start);
        $this->db->order_by('ad.'.$this->id, $this->order);
        $this->db->limit($limit, $start);
        $return = $this->db->select('ad.*, k.kecamatanname as kecamatan, r.roleName as role')
                            ->from('admin ad')
                            ->join('kecamatan k','ad.kecamatan=k.id')
                            ->join('role r','ad.role=r.roleId')
                            ->get()
                            ->result();
        return $return;
    }

    // insert data
    function insert($data)//insert data ke database
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)//update data di database
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


      function login($username, $password){
        $return = $this->db->select('id')
                  ->from('admin')
                  ->where('username',$username)
                  ->where('password',$password)
                  ->get()
                  ->row();
        if ($return) {
            return $return->id;
        }else{
            return 0;
        }
    }   

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */