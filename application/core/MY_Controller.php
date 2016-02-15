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
		$this-> reload();
	}
	
	function userLogin(){
		$username = $this->input->get_post('username');
		
		if(!empty($username)){
			$this->load->model('PlayerLogin');
			
			if($username === $this->PlayerLogin->get(array('player'=>$username))['Player'])
			{
				$this->session->set_userdata(array('username'=>$username));
			}
		}
	}
	
	function reload(){
		if($this->session->userdata('username'))
		{
			$this->data['user_welcome'] = $this->session->userdata('username');
		}
		else
		{
			$this->data['user_welcome'] = '';
			
		}
	}

}
?>