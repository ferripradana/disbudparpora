<?php  
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	/**
	* 
	*/
	class Home extends MY_Controller
	{
		
		public function _construct()
		{
			parent::__construct();
		}
		public function index(){
			$this->content = 'home';
			$this->layout();
		}
	}
?>