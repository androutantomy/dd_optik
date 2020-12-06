<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();		

		if($this->session->userdata('status') == ''){
			redirect(base_url('auth'));
		}
	}
	
	public function index()
	{
		$data['atv'] = 'home';
		$this->template->load('dashboard', $data);
	}
}
