<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_kelascabor extends MY_Controller
{
    private $base_url =  'master_kelascabor/index/';
    private $_menu = 'master_kelascabor'; 
    private $total_rows ;
    private $cabang_option ;
    private $tingkatan_option ;

    function __construct()
    {
        parent::__construct();
        $this->load->model('kelascabor_model');
        $this->load->model('cabor_model');
        $this->load->model('tingkatan_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->total_rows =  $this->kelascabor_model->total_rows();
        $this->cabang_option = $this->cabor_model->get_all_array();
        $this->tingkatan_option = $this->tingkatan_model->get_all_array();
    }

    public function index()
    {
        $keyword = '';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu );
        $this->pagination->initialize($config);
        $start = $this->uri->segment(3, 0);
        $master_kelascabor = $this->kelascabor_model->index_limit($config['per_page'], $start);

        $this->data = array(
            'master_kelascabor_data' => $master_kelascabor,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->content = 'admin/master_kelascabor/kelascabor_list';
        $this->layout();
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        
        if ($this->uri->segment(2)=='search') {
            $this->base_url = 'master_kelascabor/search/' . $keyword;
        } else {
            $this->base_url = 'master_kelascabor/index/';
        }

        $this->total_rows = $this->kelascabor_model->search_total_rows($keyword);
        $this->_menu = 'master_kelascabor/search/'.$keyword.'';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu, 1 );
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $master_kelascabor = $this->kelascabor_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'master_kelascabor_data' => $master_kelascabor,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'admin/master_kelascabor/kelascabor_list';
        $this->layout();
    }

    public function read($id) 
    {
        $row = $this->kelascabor_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'cabang' => $this->cabang_option[$row->cabang],
		'tingkatan' => $this->tingkatan_option[$row->tingkatan],
		'nama' => $row->nama,
	    );
            $this->content = 'admin/master_kelascabor/kelascabor_read';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kelascabor'));
        }
    }
    
    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('master_kelascabor/create_action'),
	    'id' => set_value('id'),
	    'cabang' => set_value('cabang'),
	    'tingkatan' => set_value('tingkatan'),
	    'nama' => set_value('nama'),
        'cabang_option' => $this->cabang_option,
        'tingkatan_option' => $this->tingkatan_option,
	);
        $this->content = 'admin/master_kelascabor/kelascabor_form';
        $this->layout();
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'cabang' => $this->input->post('cabang',TRUE),
		'tingkatan' => $this->input->post('tingkatan',TRUE),
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->kelascabor_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_kelascabor'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->kelascabor_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('master_kelascabor/update_action'),
		'id' => set_value('id', $row->id),
		'cabang' => set_value('cabang', $row->cabang),
		'tingkatan' => set_value('tingkatan', $row->tingkatan),
		'nama' => set_value('nama', $row->nama),
        'cabang_option' => $this->cabang_option,
        'tingkatan_option' => $this->tingkatan_option,
	    );
            $this->content = 'admin/master_kelascabor/kelascabor_form';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kelascabor'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'cabang' => $this->input->post('cabang',TRUE),
		'tingkatan' => $this->input->post('tingkatan',TRUE),
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->kelascabor_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_kelascabor'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->kelascabor_model->get_by_id($id);

        if ($row) {
            $this->kelascabor_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_kelascabor'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kelascabor'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('cabang', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('tingkatan', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('nama', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    

};

/* End of file master_kelascabor.php */
/* Location: ./application/controllers/master_kelascabor.php */