<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_jenis extends My_Controller
{
    private $base_url =  'jenis/index/';
    private $_menu = 'jenis'; 
    private $total_rows ;

    function __construct()
    {
        parent::__construct();
        $this->load->model('jenis_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->total_rows =  $this->jenis_model->total_rows();
    }

    public function index()
    {
        $keyword = '';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu );
        $this->pagination->initialize($config);
        $start = $this->uri->segment(3, 0);
        $master_jenis = $this->jenis_model->index_limit($config['per_page'], $start);

        $this->data = array(
            'master_jenis_data' => $master_jenis,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->content = 'admin/master_jenis/jenis_list';
        $this->layout();
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'master_jenis/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'master_jenis/index/';
        }

        $this->total_rows = $this->jenis_model->search_total_rows($keyword);
        $this->_menu = 'jenis/search/'.$keyword.'';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu, 1 );

        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $master_jenis = $this->jenis_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'master_jenis_data' => $master_jenis,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'admin/master_jenis/jenis_list';
        $this->layout();

    }

    public function read($id) 
    {
        $row = $this->jenis_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'jenisname' => $row->jenisname,
	    );
            $this->content = 'admin/master_jenis/jenis_read';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_jenis'));
        }
    }
    
    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('master_jenis/create_action'),
	    'id' => set_value('id'),
	    'jenisname' => set_value('jenisname'),
	);
        $this->content = 'admin/master_jenis/jenis_form';
        $this->layout();
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'jenisname' => $this->input->post('jenisname',TRUE),
	    );

            $this->jenis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_jenis'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->jenis_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('master_jenis/update_action'),
		'id' => set_value('id', $row->id),
		'jenisname' => set_value('jenisname', $row->jenisname),
	    );
            $this->content = 'admin/master_jenis/jenis_form';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_jenis'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'jenisname' => $this->input->post('jenisname',TRUE),
	    );

            $this->jenis_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_jenis'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->jenis_model->get_by_id($id);

        if ($row) {
            $this->jenis_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_jenis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_jenis'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jenisname', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file master_jenis.php */
/* Location: ./application/controllers/master_jenis.php */