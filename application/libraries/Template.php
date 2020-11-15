<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance(); 
	}
	
	function load($view = '' , $data = array())
	{               
		$this->ci->load->view('template/header', $data);
		$this->ci->load->view($view, $data);
		$this->ci->load->view('template/footer');
	}
}