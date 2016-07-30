<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Saranaolahraga extends My_Controller
{
    private $base_url = 'saranaolahraga/index';
    private $_menu = 'saranaolahraga';
    private $total_rows ;
    private $kecamatan_option;
    function __construct()
    {
        parent::__construct();
        $this->load->model('saranaolahraga_model');
        $this->load->library('form_validation');
        $this->load->model('kecamatan_model');
        $this->load->library('pagination');
        $this->total_rows =  $this->saranaolahraga_model->total_rows();
        $this->kecamatan_option = $this->kecamatan_model->get_all_array();
    }

    public function index()
    {
        $keyword = '';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu );
        $this->pagination->initialize($config);
        $start = $this->uri->segment(3, 0);
        $saranaolahraga = $this->saranaolahraga_model->index_limit($config['per_page'], $start);

        $this->data = array(
            'saranaolahraga_data' => $saranaolahraga,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->content = 'sapras/saranaolahraga/saranaolahraga_list';
        $this->layout();
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'saranaolahraga/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'saranaolahraga/index/';
        }
        $this->total_rows = $this->saranaolahraga_model->search_total_rows($keyword);
        $this->_menu = 'saranaolahraga/search/'.$keyword.'';
        $config = getConfigPaging($this->base_url, $this->total_rows, $this->_menu, 1 );

        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $saranaolahraga = $this->saranaolahraga_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'saranaolahraga_data' => $saranaolahraga,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'sapras/saranaolahraga/saranaolahraga_list';
        $this->layout();
    }

    public function read($id) 
    {
        $row = $this->saranaolahraga_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'name' => $row->name,
		'alamat' => $row->alamat,
		'kecamatan' => $this->kecamatan_option[$row->kecamatan],
		'kondisi' => $row->kondisi,
		'kategori' => $row->kategori,
		'kepemilikan' => $row->kepemilikan,
		'kapasitas' => $row->kapasitas,
	    );
            $this->content = 'sapras/saranaolahraga/saranaolahraga_read';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saranaolahraga'));
        }
    }
    
    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('saranaolahraga/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'alamat' => set_value('alamat'),
	    'kecamatan' => set_value('kecamatan'),
	    'kondisi' => set_value('kondisi'),
	    'kategori' => set_value('kategori'),
	    'kepemilikan' => set_value('kepemilikan'),
	    'kapasitas' => set_value('kapasitas'),
        'kecamatan_option' => $this->kecamatan_option,
	);
        $this->content = 'sapras/saranaolahraga/saranaolahraga_form';
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
		'alamat' => $this->input->post('alamat',TRUE),
		'kecamatan' => $this->input->post('kecamatan',TRUE),
		'kondisi' => $this->input->post('kondisi',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'kepemilikan' => $this->input->post('kepemilikan',TRUE),
		'kapasitas' => $this->input->post('kapasitas',TRUE),
	    );

            $this->saranaolahraga_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('saranaolahraga'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->saranaolahraga_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('saranaolahraga/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
		'alamat' => set_value('alamat', $row->alamat),
		'kecamatan' => set_value('kecamatan', $row->kecamatan),
		'kondisi' => set_value('kondisi', $row->kondisi),
		'kategori' => set_value('kategori', $row->kategori),
		'kepemilikan' => set_value('kepemilikan', $row->kepemilikan),
		'kapasitas' => set_value('kapasitas', $row->kapasitas),
        'kecamatan_option' => $this->kecamatan_option,
	    );
            $this->content = 'sapras/saranaolahraga/saranaolahraga_form';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saranaolahraga'));
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
		'alamat' => $this->input->post('alamat',TRUE),
		'kecamatan' => $this->input->post('kecamatan',TRUE),
		'kondisi' => $this->input->post('kondisi',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'kepemilikan' => $this->input->post('kepemilikan',TRUE),
		'kapasitas' => $this->input->post('kapasitas',TRUE),
	    );

            $this->saranaolahraga_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('saranaolahraga'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->saranaolahraga_model->get_by_id($id);

        if ($row) {
            $this->saranaolahraga_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('saranaolahraga'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saranaolahraga'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', ' ', 'trim|required');
	$this->form_validation->set_rules('alamat', ' ', 'trim|required');
	$this->form_validation->set_rules('kecamatan', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('kondisi', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('kategori', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('kepemilikan', ' ', 'trim|required');
	$this->form_validation->set_rules('kapasitas', ' ', 'trim|required|numeric');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "saranaolahraga.xls";
        $judul = "saranaolahraga";
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
	xlsWriteLabel($tablehead, $kolomhead++, "alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "kecamatan");
	xlsWriteLabel($tablehead, $kolomhead++, "kondisi");
	xlsWriteLabel($tablehead, $kolomhead++, "kategori");
	xlsWriteLabel($tablehead, $kolomhead++, "kepemilikan");
	xlsWriteLabel($tablehead, $kolomhead++, "kapasitas");

	foreach ($this->saranaolahraga_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kecamatan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kondisi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kategori);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kepemilikan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kapasitas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file saranaolahraga.php */
/* Location: ./application/controllers/saranaolahraga.php */