<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assetolahraga extends My_Controller
{
    private $base_url = 'assetolahraga/index';
    private $_menu = 'assetolahraga';
    private $total_rows ;
    private $kecamatan_option;
    function __construct()
    {
        parent::__construct();
        $this->load->model('assetolahraga_model');
        $this->load->library('form_validation');
        $this->load->model('kecamatan_model');
        $this->load->library('pagination');
        $this->total_rows =  $this->assetolahraga_model->total_rows();
        $this->kecamatan_option = $this->kecamatan_model->get_all_array();
    }

    public function index()
    {
        $keyword = '';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu );
        $this->pagination->initialize($config);
        $start = $this->uri->segment(3, 0);
        $assetolahraga = $this->assetolahraga_model->index_limit($config['per_page'], $start);

        $this->data = array(
            'assetolahraga_data' => $assetolahraga,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->content = 'sapras/assetolahraga/assetolahraga_list';
        $this->layout(); 
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'assetolahraga/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'assetolahraga/index/';
        }
        $this->total_rows = $this->assetolahraga_model->search_total_rows($keyword);
        $this->_menu = 'assetolahraga/search/'.$keyword.'';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu, 1 );
        
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $assetolahraga = $this->assetolahraga_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'assetolahraga_data' => $assetolahraga,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'sapras/assetolahraga/assetolahraga_list';
        $this->layout(); 
    }

    public function read($id) 
    {
        $row = $this->assetolahraga_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'name' => $row->name,
        'kecamatan' => $this->kecamatan_option[$row->kecamatan],
		'tahun' => $row->tahun,
		'kondisi' => $row->kondisi,
	    );
            $this->content = 'sapras/assetolahraga/assetolahraga_read';
            $this->layout(); 
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('assetolahraga'));
        }
    }
    
    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('assetolahraga/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
        'kecamatan' => set_value('kecamatan'),
	    'tahun' => set_value('tahun'),
	    'kondisi' => set_value('kondisi'),
        'kecamatan_option' => $this->kecamatan_option,
	);
        $this->content = 'sapras/assetolahraga/assetolahraga_form';
        $this->layout(); 
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
        'kecamatan' => $this->input->post('kecamatan',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'kondisi' => $this->input->post('kondisi',TRUE),
	    );

            $this->assetolahraga_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('assetolahraga'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->assetolahraga_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('assetolahraga/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
        'kecamatan' => set_value('kecamatan', $row->kecamatan),
		'tahun' => set_value('tahun', $row->tahun),
		'kondisi' => set_value('kondisi', $row->kondisi),
        'kecamatan_option' => $this->kecamatan_option,
	    );
            $this->content = 'sapras/assetolahraga/assetolahraga_form';
            $this->layout(); 
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('assetolahraga'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
        'kecamatan' => $this->input->post('kecamatan',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'kondisi' => $this->input->post('kondisi',TRUE),
	    );

            $this->assetolahraga_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('assetolahraga'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->assetolahraga_model->get_by_id($id);

        if ($row) {
            $this->assetolahraga_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('assetolahraga'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('assetolahraga'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', ' ', 'trim|required');
    $this->form_validation->set_rules('kecamatan', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('tahun', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('kondisi', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "assetolahraga.xls";
        $judul = "assetolahraga";
        $tablehead = 2;
        $tablebody = 3;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        xlsWriteLabel(0, 0, $judul);

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "no");
	xlsWriteLabel($tablehead, $kolomhead++, "name");
	xlsWriteLabel($tablehead, $kolomhead++, "tahun");
	xlsWriteLabel($tablehead, $kolomhead++, "kondisi");

	foreach ($this->assetolahraga_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kondisi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file assetolahraga.php */
/* Location: ./application/controllers/assetolahraga.php */