<?php  
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_menu extends MY_Controller
{
    private $option;
    function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->library('form_validation');
        $this->option = $this->menu_model->get_all_array();
    }

    public function index()
    {
        $master_menu = $this->menu_model->get_all_tomenu();
         $generated_menu =   $this->get_menu($master_menu,0);
        $this->data= array(
            'menu' => json_encode($generated_menu), 
        ); 

        $this->content = 'admin/master_menu/menu_list';
        $this->layout();// memangil method layout
    }
    
   


    
    public function create() //Masuk form create
    {
        // print_r($this->option); die();
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('master_menu/create_action'),
	        'menuId' => set_value('menuId'),
            'menuName' => set_value('menuName'),
            'menuParent' => set_value('menuParent'),
            'menuLink'  => set_value('menuLink'),
            'menuPosition' => set_value('menuPosition'),
            'option'    => $this->option,    
	    );
        $this->content = 'admin/master_menu/menu_form';
        $this->layout();
    }
    
    public function create_action() //Mensyimpan data create ke database melalui model
    {
        //menuId, menuName, menuParent, menuLink, menuPosition
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
    		     'menuName' => $this->input->post('menuName',TRUE), 
                 'menuLink' => $this->input->post('menuLink',TRUE),  
                 'menuParent' =>  $this->input->post('menuParent',TRUE),
                 'menuPosition' => $this->input->post('menuPosition', true)  
	        );

            $this->menu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_menu'));
        }
    }
    
    public function update($id) //menuju ke form update
    {
        $row = $this->menu_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('master_menu/update_action'),
                'menuId'   => $row->menuId,
                'menuName' => $row->menuName, 
                 'menuLink' => $row->menuLink,  
                 'menuParent' =>  $row->menuParent,
                 'menuPosition' => $row->menuPosition,  
                 'option'   => $this->option,
	        );
            $this->content = 'admin/master_menu/menu_form';
            $this->layout();
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_menu'));
        }
    }
    
    public function update_action() //melakukan update ke database melalui model
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('menuId', TRUE));
        } else {
            $data = array(
        		  'menuName' => $this->input->post('menuName',TRUE), 
                 'menuLink' => $this->input->post('menuLink',TRUE),  
                 'menuParent' =>  $this->input->post('menuParent',TRUE),
                 'menuPosition' => $this->input->post('menuPosition', true)  
    	    );

            $this->menu_model->update($this->input->post('menuId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_menu'));
        }
    }
    
    public function delete($id) //melakukan delete data
    {
        $row = $this->menu_model->get_by_id($id);

        if ($row) {
            $this->menu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_menu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_menu'));
        }
    }

    public function _rules() //aturan validasi untuk form
    {
    	$this->form_validation->set_rules('menuName', ' ', 'trim|required');
        $this->form_validation->set_rules('menuLink', ' ', 'trim|required');
        $this->form_validation->set_rules('menuPosition', ' ', 'trim|required|numeric');
    	$this->form_validation->set_rules('menuId', 'id', 'trim');
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
  



};
?>