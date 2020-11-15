<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data['atv'] = 'home';
		$this->template->load('dashboard', $data);
	}
}
