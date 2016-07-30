<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_kecamatan extends My_Controller
{
    private $base_url =  'master_kecamatan/index/';
    private $_menu = 'master_kecamatan'; 

    function __construct()
    {
        parent::__construct();
        $this->load->model('kecamatan_model');
        $this->load->library('form_validation');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->total_rows =  $this->kecamatan_model->total_rows();
    }

    public function index()
    {
        $keyword = '';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu );
        $this->pagination->initialize($config);
        $start = $this->uri->segment(3, 0);
        $master_kecamatan = $this->kecamatan_model->index_limit($config['per_page'], $start);

        $this->data = array(
            'master_kecamatan_data' => $master_kecamatan,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->content = 'admin/master_kecamatan/kecamatan_list';
        $this->layout();
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(2)=='search') {
            $this->base_url = base_url() . 'master_kecamatan/search/' . $keyword;
        } else {
            $this->base_url = base_url() . 'master_kecamatan/index/';
        }

        $this->total_rows = $this->kecamatan_model->search_total_rows($keyword);
        $this->_menu = 'kecamatan/search/'.$keyword.'';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu, 1 );

        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $master_kecamatan = $this->kecamatan_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'master_kecamatan_data' => $master_kecamatan,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'admin/master_kecamatan/kecamatan_list';
        $this->layout();

    }

    public function read($id) 
    {
        $row = $this->kecamatan_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'kecamatanname' => $row->kecamatanname,
	    );
            $this->content = 'admin/master_kecamatan/kecamatan_read';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kecamatan'));
        }
    }
    
    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('master_kecamatan/create_action'),
	    'id' => set_value('id'),
	    'kecamatanname' => set_value('kecamatanname'),
	);
        $this->content = 'admin/master_kecamatan/kecamatan_form';
        $this->layout();
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kecamatanname' => $this->input->post('kecamatanname',TRUE),
	    );

            $this->kecamatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_kecamatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->kecamatan_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('master_kecamatan/update_action'),
		'id' => set_value('id', $row->id),
		'kecamatanname' => set_value('kecamatanname', $row->kecamatanname),
	    );
            $this->content = 'admin/master_kecamatan/kecamatan_form';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kecamatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'kecamatanname' => $this->input->post('kecamatanname',TRUE),
	    );

            $this->kecamatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_kecamatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->kecamatan_model->get_by_id($id);

        if ($row) {
            $this->kecamatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_kecamatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kecamatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kecamatanname', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file master_kecamatan.php */
/* Location: ./application/controllers/master_kecamatan.php */