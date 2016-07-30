<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_cabor extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('cabor_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'master_cabor/index/';
        $config['total_rows'] = $this->cabor_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'master_cabor';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $master_cabor = $this->cabor_model->index_limit($config['per_page'], $start);

        $this->data = array(
            'master_cabor_data' => $master_cabor,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->content = 'admin/master_cabor/cabor_list';
        $this->layout();
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'master_cabor/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'master_cabor/index/';
        }

        $config['total_rows'] = $this->cabor_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'master_cabor/search/'.$keyword.'';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $master_cabor = $this->cabor_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'master_cabor_data' => $master_cabor,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'admin/master_cabor/cabor_list';
        $this->layout();
    }

    public function read($id) 
    {
        $row = $this->cabor_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'caborname' => $row->caborname,
	    );
            $this->content = 'admin/master_cabor/cabor_read';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_cabor'));
        }
    }
    
    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('master_cabor/create_action'),
	    'id' => set_value('id'),
	    'caborname' => set_value('caborname'),
	);
        $this->content = 'admin/master_cabor/cabor_form';
        $this->layout();
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'caborname' => $this->input->post('caborname',TRUE),
	    );

            $this->cabor_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_cabor'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->cabor_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('master_cabor/update_action'),
		'id' => set_value('id', $row->id),
		'caborname' => set_value('caborname', $row->caborname),
	    );
            $this->content = 'admin/master_cabor/cabor_form';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_cabor'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'caborname' => $this->input->post('caborname',TRUE),
	    );

            $this->cabor_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_cabor'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->cabor_model->get_by_id($id);

        if ($row) {
            $this->cabor_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_cabor'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_cabor'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('caborname', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
};

/* End of file master_cabor.php */
/* Location: ./application/controllers/master_cabor.php */