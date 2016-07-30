<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_tingkatan extends My_Controller
{
    private $base_url =  'tingkatan/index/';
    private $_menu = 'tingkatan'; 
    private $total_rows ;

    function __construct()
    {
        parent::__construct();
        $this->load->model('tingkatan_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->total_rows =  $this->tingkatan_model->total_rows();
    }

    public function index()
    {
        $keyword = '';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu );
        $this->pagination->initialize($config);
        $start = $this->uri->segment(3, 0);
        $master_tingkatan = $this->tingkatan_model->index_limit($config['per_page'], $start);

        $this->data = array(
            'master_tingkatan_data' => $master_tingkatan,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->content = 'admin/master_tingkatan/tingkatan_list';
        $this->layout();
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'master_tingkatan/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'master_tingkatan/index/';
        }

        $this->total_rows = $this->tingkatan_model->search_total_rows($keyword);
        $this->_menu = 'tingkatan/search/'.$keyword.'';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu, 1 );

        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $master_tingkatan = $this->tingkatan_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'master_tingkatan_data' => $master_tingkatan,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'admin/master_tingkatan/tingkatan_list';
        $this->layout();

    }

    public function read($id) 
    {
        $row = $this->tingkatan_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'tingkatanname' => $row->tingkatanname,
	    );
            $this->content = 'admin/master_tingkatan/tingkatan_read';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_tingkatan'));
        }
    }
    
    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('master_tingkatan/create_action'),
	    'id' => set_value('id'),
	    'tingkatanname' => set_value('tingkatanname'),
	);
        $this->content = 'admin/master_tingkatan/tingkatan_form';
        $this->layout();
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tingkatanname' => $this->input->post('tingkatanname',TRUE),
	    );

            $this->tingkatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_tingkatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->tingkatan_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('master_tingkatan/update_action'),
		'id' => set_value('id', $row->id),
		'tingkatanname' => set_value('tingkatanname', $row->tingkatanname),
	    );
            $this->content = 'admin/master_tingkatan/tingkatan_form';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_tingkatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'tingkatanname' => $this->input->post('tingkatanname',TRUE),
	    );

            $this->tingkatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_tingkatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->tingkatan_model->get_by_id($id);

        if ($row) {
            $this->tingkatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_tingkatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_tingkatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tingkatanname', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};