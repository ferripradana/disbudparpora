<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 5/31/2016
 * Time: 10:50 PM
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Master_role extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('role_model');
        $this->load->model('menu_model');
          $this->load->model('menurole_model');
        $this->load->library('form_validation');
    }

    public function index()//menampilkan data dari model ke view menjadi berupa tampilan pagination
    {
        $keyword = '';
        $this->load->library('pagination');// memamngil library pagination

        $config['base_url'] = base_url() . 'master_role/index/';//menyambung base url dengan master_admin/index/ kemudian disimpan ke config base_url
        $config['total_rows'] = $this->role_model->total_rows();//memangil method total_rows di admin_model kemudian disimpan ke config total rows
        $config['per_page'] = 10;//menyimpan nilai 10 di config per_page yang difungsikan untuk pagination 10 data setiap pagenya
        $config['uri_segment'] = 3;//menyimpan nilai 3 pada config uri_segment yang akan digunakan url pada index data dalam bentuk pagination
        $config['suffix'] = '';//Menyimpan nilai string kosong di config sufix
        $config['first_url'] = base_url() . 'master_role';//menyambung base url dengan master_admin kemudian disimpan ke config base_url
        $this->pagination->initialize($config);//masukkan nilai config di method initialize yang ada di obyek pagination

        $start = $this->uri->segment(3, 0);//set nilai 3 dan 0 di method uri kemudian simpan nilai balikannya di start// start akan difungsikan sebagai penomeran di tabel
        $master_role = $this->role_model->index_limit($config['per_page'], $start);//set nilai config per_page dan start ke method index limit di obyek admin_model kemudian simpan nilai balikannya di master_user
        // master_user akan di pake untuk penyimpanan data berupa index berbatas

        $this->data = array(
            'master_role' => $master_role,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );  //menyimpan array dari
        //dari data master_users yang memiliki nama indeks master_users_data
        //keyword yang memiliki nama indeks keyword
        //create links di pagination yang memiliki nama indeks pagination
        //config total_row yang memiliki nilai nama indeks total rows
        //start yang memiliki nama indeks start
        // ke data

        $this->content = 'admin/master_role/role_list';// menyimpan nilai admin/master_admin/admin_list ke content difungsikan untuk penetapan content di MY_Controller
        $this->layout();// memangil method layout
    }

    public function search() //pencarian
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');

        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'master_role/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'master_role/index/';
        }

        $config['total_rows'] = $this->role_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . 'master_role/search/'.$keyword.'';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $master_role = $this->role_model->search_index_limit($config['per_page'], $start, $keyword);

        $this->data = array(
            'master_role' => $master_role,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->content = 'admin/master_role/role_list';
        $this->layout();
    }

    public function read($id) //membaca data
    {
        $row = $this->role_model->get_by_id($id);
        if ($row) {
            $this->data = array(
                'roleId' => $row->roleId,
                'roleName' => $row->roleName,
            );
            $this->content = 'admin/master_role/role_read';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_role'));
        }
    }

    public function create() //Masuk form create
    {
        $master_menu = $this->menu_model->get_all_tomenu();
        $generated_menu =   $this->get_menu($master_menu,0);


        $this->data = array(
            'button' => 'Create',
            'action' => site_url('master_role/create_action'),
            'roleId' => set_value('roleId'),
            'roleName' => set_value('roleName'),
             'menu' => json_encode($generated_menu), 
        );
        $this->content = 'admin/master_role/role_form';
        $this->layout();
    }

    public function create_action() //Mensyimpan data create ke database melalui model
    {
      
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'roleName' => $this->input->post('roleName',TRUE),
            );
            $id = $this->role_model->insert($data);
            if (isset($_POST['ck'])) {
                foreach ($_POST['ck'] as $key => $value) {
                    $datarole = array(
                        'menuId' => $key,
                        'menuRole' => $id,
                        'isview' => isset($value['ckView']) ? 1: 0 ,
                        'iscreate' => isset($value['ckCreate']) ? 1: 0 ,
                        'isupdate' => isset($value['ckUpdate']) ? 1: 0 ,
                        'isdelete' => isset($value['ckDelete']) ? 1: 0 ,
                    );
                    $this->menurole_model->insert($datarole);
                }
            }
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_role'));
        }
    }

    public function update($id) //menuju ke form update
    {   
      
        $row = $this->role_model->get_by_id($id);

        if ($row) {
            $master_menu =  $this->role_model->getrolemenu($id);  
            $generated_menu =   $this->get_menu($master_menu,0);


            $this->data = array(
                'button' => 'Update',
                'action' => site_url('master_role/update_action'),
                'roleId' => set_value('roleId', $row->roleId),
                'roleName' => set_value('roleName', $row->roleName),
                'menu'   => json_encode($generated_menu), 
            );
            $this->content = 'admin/master_role/role_form';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_role'));
        }
    }

    public function update_action() //melakukan update ke database melalui model
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('roleId', TRUE));

        } else {
            $data = array(
                'roleName' => $this->input->post('roleName',TRUE),
            );

            $this->role_model->update($this->input->post('roleId', TRUE), $data);
            $this->menurole_model->delete($this->input->post('roleId', TRUE));
            if (isset($_POST['ck'])) {
                foreach ($_POST['ck'] as $key => $value) {
                    $datarole = array(
                        'menuId' => $key,
                        'menuRole' => $this->input->post('roleId', TRUE),
                        'isview' => isset($value['ckView']) ? 1: 0 ,
                        'iscreate' => isset($value['ckCreate']) ? 1: 0 ,
                        'isupdate' => isset($value['ckUpdate']) ? 1: 0 ,
                        'isdelete' => isset($value['ckDelete']) ? 1: 0 ,
                    );
                    $this->menurole_model->insert($datarole);
                }
            }



            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_role'));
        }
    }

    public function delete($id) //melakukan delete data
    {
        $row = $this->role_model->get_by_id($id);

        if ($row) {
            $this->role_model->delete($id);
            $this->menurole_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_role'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_role'));
        }
    }

    public function _rules() //aturan validasi untuk form
    {
        $this->form_validation->set_rules('roleName', ' ', 'trim|required');
        $this->form_validation->set_rules('roleId', 'roleId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function get_menu($results,$parent_id){
        $menu = array();
            foreach ($results as $element) {
                if ($element['menuParent'] == $parent_id) {
                    $children = $this->get_menu($results, $element['menuId']);
                    if ($children) { 
                       $element['children'] = $children;
                    }else{
                        $element['children'] = array();
                    }
                    $menu[] = $element;
                }
            }

        return $menu;
    }


}