<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
        $this->load->model('admin_model');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->helper('uploading');
        $this->load->model('role_model');
        $this->load->model('menu_model');
    }

    public function index()
    {   

         $user = $this->session->userdata('username_admin');
         if ($user) {
            redirect(site_url('master_admin'));
         }else{
            $this->load->view('admin/login');      
         }

      
    }

    public function logout(){http://localhost/ci-simpeg/
        $this->session->unset_userdata('username_admin');
        $this->session->unset_userdata('username_akses');
         $this->session->unset_userdata('akses');
        $this->session->unset_userdata('list_role');
        redirect('');
    }

    public function submit(){
        $username = $this->input->post('username' , true);
        $password =  $this->encrypt->hash($this->input->post('password' , true));
          $login = $this->admin_model->login($username, $password);
           if ($login) {
            $user = $this->admin_model->get_by_id($login);
          
            $master_menu =  $this->role_model->getrolemenu($user->role);  




            $list_role = array();
            foreach ($master_menu as $key => $value) {
                $list_role[$value['menuLink']] = $value;
            }
    

            $generated_menu =  get_menu($master_menu,0);

            $this->session->set_userdata('username_admin', $username);
            $this->session->set_userdata('akses', json_encode($generated_menu) );
            $this->session->set_userdata('list_role', $list_role ); 
            $this->session->set_userdata('kecamatan', $user->kecamatan);    

          

            redirect('home');
        }else{ 
            $data = array( 
                'error' => 'Username or password false',
            );
            $this->load->view('admin/login',$data);
        }
    }
};

/* End of file master_admin.php */
/* Location: ./application/controllers/master_admin.php */