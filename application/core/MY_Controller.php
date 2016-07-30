<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class MY_Controller extends CI_Controller
{
  
  var $template = array();
  var $data = array();
  var $page = '';
  var $model = '';
  var $input = array();
  public $userdata = array();
  public function __construct()
  {
       parent::__construct();
     
     
       $this->is_logged_in(); 
       $this->load->library('pagination');
       $this->load->library('form_validation');
       $this->load->helper('uploading');
       $this->isact();
  }
  public function is_logged_in(){

       $user = $this->session->userdata('username_admin');
    
       if (!$user) {
            redirect('');
        }
        $this->userdata =array(
            '_username' => $user,
        );
  }
  public function isact(){
    $path = $this->uri->segment(2);
    if ($path=='delete') {
      $this->aksesList();
    }
  }


  public function aksesList(){
      $path = $this->uri->segment(1);
      $this->data['_username'] = $this->session->userdata('username_admin');
      $this->data['_akses'] = $this->session->userdata('akses');
      $this->data['list_role'] =  $this->session->userdata('list_role'); 
       
  
      $this->data['isview'] = isset(  $this->data['list_role'][$path]['isview'] ) ? ($this->data['list_role'][$path]['isview'] ==1 )?1:0  : 0  ;
      $this->data['iscreate'] = isset(  $this->data['list_role'][$path]['iscreate'] ) ? ($this->data['list_role'][$path]['iscreate'] ==1 )?1:0  : 0  ;
      $this->data['isupdate'] = isset(  $this->data['list_role'][$path]['isupdate'] ) ? ($this->data['list_role'][$path]['isupdate'] ==1 )?1:0  : 0   ;
      $this->data['isdelete'] = isset(  $this->data['list_role'][$path]['isdelete'] ) ? ($this->data['list_role'][$path]['isdelete'] ==1 )?1:0  : 0   ;
      //

      if ($this->data['isview']!=1 && $path!='home' ) {
          redirect(site_url('home'));
      }
      if ($this->data['iscreate']!=1 &&  $this->uri->segment(2)=='create' ) {
           redirect(site_url($path));
      }
      if ($this->data['isupdate']!=1  &&  $this->uri->segment(2)=='update') {
           redirect(site_url($path));
      }
      if ($this->data['isdelete']!=1  &&  $this->uri->segment(2)=='delete') {
          redirect(site_url($path));
      }



  }



  public function layout(){
      // echo $this->session->userdata('kecamatan'); die();
      $this->aksesList();
      $this->template['sidebar']   = $this->load->view('template/sidebar', $this->data, true);
      $this->template['top']   = $this->load->view('template/top', $this->data, true);
      $this->template['content'] = $this->load->view($this->content, $this->data, true);
      $this->template['footer'] = $this->load->view('template/footer', $this->data, true);
      $this->load->view('template/layout', $this->template);
  }

  public function doUpload($filename){
        $name = '';
        // echo $filename; die();
        if ($_FILES[$filename]['size']>0) {

            $conf = getConfigUpload($_FILES[$filename]['name']);
            // print_r($conf); die();
            $this->load->library('upload',$conf);
            if ($_FILES[$filename]['name']&&!$this->upload->do_upload($filename)) {
                 echo "gagal";
            }else{
                $name = $conf['file_name'];
                $image_data = $this->upload->data();
                $config_thumb = getConfigThumb($image_data['full_path']);
                $this->load->library('image_lib', $config_thumb);
                $this->image_lib->resize(); 
            }
        }
        return $name;
  }
  public function deleteOldPhoto($filename){
      if ( unlink('./upload/'.$filename)) { 
          $del = 1;
      }
      if (unlink('./upload/thumbs/'.$filename)) {
          $del_thumbs = 1;
      }
  }



}

?>










