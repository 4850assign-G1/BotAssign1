<?php
Class Application extends CI_Controller {
	protected $data = array();
	protected $id;
	
	function __construct(){
		parent::__construct();
		$this->load->library("parser");
		
		$this->data = array();
		$this->errors = array();
		
		$this-> userLogin();
	}
	
	function userLogin(){
		$username = $this->input->get_post('username');
		
		if(!empty($username)){
			$this->load->model('PlayerLogin');
			
			if($username === $this->PlayerLogin->get(array('player'=>$username))['player'])
			{
				$this->session->set_userdata(array('username'=>$username));
			}
		}
	}

}
?>