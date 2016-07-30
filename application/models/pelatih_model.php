<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelatih_model extends CI_Model
{

    public $table = 'pelatih';
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

    function get_all_excel(){

            $this->load->model('sertifikatpelatih_model');
            $this->db->order_by('nama', 'asc');
             if ($this->session->userdata('kecamatan')!=27) {
                 $this->db->where('kecamatan',$this->session->userdata('kecamatan'));
            }
           $return = $this->db->select('p.*, k.kecamatanname as kecamatan, c.caborname as cabang, j.jenisname as jenis')
                            ->from('pelatih p')
                            ->join('kecamatan k','p.kecamatan=k.id')
                            ->join('cabor c','p.cabang=c.id')
                            ->join('jenis j','p.jenis=j.id')
                            ->get()
                            ->result();
            $output = array();
            foreach ($return as $key => $value) {
                $output[$value->id] = (array) $value;
                $sertifikat = $this->sertifikatpelatih_model->get_by_pelatih($value->id);
                foreach ($sertifikat as $kp => $vp) {
                    $output[$value->id]['sertifikat'][] = (array) $vp; 
                }
            }
        return $output;
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
        $this->db->order_by('p.'.$this->id, $this->order);
        $this->db->limit($limit, $start);
         if ($this->session->userdata('kecamatan')!=27) {
             $this->db->where('kecamatan',$this->session->userdata('kecamatan'));
        }
        $return = $this->db->select('p.*, k.kecamatanname as kecamatan, c.caborname as cabang, j.jenisname as jenis')
                            ->from('pelatih p')
                            ->join('kecamatan k','p.kecamatan=k.id')
                            ->join('cabor c','p.cabang=c.id')
                            ->join('jenis j','p.jenis=j.id')
                            ->get()
                            ->result();
        return $return;
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {

	$this->db->or_like('j.jenisname', $keyword);
    $this->db->or_like('c.caborname', $keyword);
	$this->db->or_like('k.kecamatanname', $keyword);
	$this->db->or_like('nama', $keyword);
	$this->db->or_like('tmp_lahir', $keyword);
	$this->db->or_like('tgl_lahir', $keyword);
	$this->db->or_like('alamat', $keyword);
	$this->db->or_like('kelamin', $keyword);
	$this->db->or_like('telepon', $keyword);
	$this->db->or_like('foto', $keyword);
     if ($this->session->userdata('kecamatan')!=27) {
             $this->db->where('kecamatan',$this->session->userdata('kecamatan'));
        }
    $this->db->select('p.*, k.kecamatanname as kecamatan, c.caborname as cabang, j.jenisname as jenis')
                            ->from('atlit p')
                            ->join('kecamatan k','p.kecamatan=k.id')
                            ->join('cabor c','p.cabang=c.id')
                            ->join('jenis j','p.jenis=j.id');
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
    	$this->db->or_like('j.jenisname', $keyword);
    $this->db->or_like('c.caborname', $keyword);
	$this->db->or_like('k.kecamatanname', $keyword);
	$this->db->or_like('nama', $keyword);
	$this->db->or_like('tmp_lahir', $keyword);
	$this->db->or_like('tgl_lahir', $keyword);
	$this->db->or_like('alamat', $keyword);
	$this->db->or_like('kelamin', $keyword);
	$this->db->or_like('telepon', $keyword);
	$this->db->or_like('foto', $keyword);
     if ($this->session->userdata('kecamatan')!=27) {
             $this->db->where('kecamatan',$this->session->userdata('kecamatan'));
        }
	$this->db->limit($limit, $start);

    $this->db->order_by('p.'.$this->id, $this->order);
        $this->db->limit($limit, $start);

        $return = $this->db->select('p.*, k.kecamatanname as kecamatan, c.caborname as cabang, j.jenisname as jenis')
                            ->from('pelatih p')
                            ->join('kecamatan k','p.kecamatan=k.id')
                            ->join('cabor c','p.cabang=c.id')
                            ->join('jenis j','p.jenis=j.id')
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

/* End of file pelatih_model.php */
/* Location: ./application/models/pelatih_model.php */