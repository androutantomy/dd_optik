<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
	}

	public function index()
	{
		$this->load->view('login');
	}

	function aksi_login(){


		$username = $this->input->post('username');
		$password = sha1(md5($this->input->post('password')));
		$where = array(
			'username' => $username,
			'password' => sha1(md5($password))
			);
		$cek_login = $this->m_login->cek_login($username,$password)->num_rows();
		if($cek_login > 0){
 
			$data_session = array(
				'nama_lengkap' => $nama_lengkap,
				'id_toko' => $id_toko,
				'id_level' => $id_level,			
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("Dashboard"));
 
		}else{
			echo "Username atau password salah !";
		}
	}
// =====================================================================================================

	// 	$username = $this->input->post('username');
	// 	$password = sha1(md5($this->input->post('password')));
	// 	$cek_login = $this->m_login->cek_login($username, $password);
	// 	echo $this->db->last_query();
	// 	if($cek_login-> num_rows() < 0){
	// 		print_r($id_level);exit;
	// 		echo "Username dan password salah !";
	// 		redirect(base_url('Auth'));
	// 		return;
	// 	}

	// 	$data  			= $cek_login->row_array();
	// 	$id 			= $data['id'];
	// 	$username  		= $data['username'];
	// 	$password  		= $data['password'];
	// 	$nama_lengkap 	= $data['nama_lengkap'];
	// 	$id_toko 		= $data['id_toko'];
	// 	$id_level 		= $data['id_level'];
	// 	// print_r($id_level);exit;

	// 		$data_session = array(
	// 			'username' 		=> $username,
	// 			'nama_lengkap' 	=> $nama_lengkap,
	// 			'id_toko' 		=> $id_toko,
	// 			'id_level' 		=> $id_level,
	// 			'status' 		=> "login"
	// 			);
 
	// 		$this->session->set_userdata($data_session);
	// 		//akses ke SUPER ADMIN
	// 	if ($id_level == 3){
	// 		redirect(base_url('Dashboard'));
	// 		//ADMIN
	// 	} else if ($id_level == 5){
	// 		redirect(base_url('Dashboard'));
	// 		//PENJAGA TOKO
	// 	} else if ($id_level == 4){
	// 		redirect(base_url('Dashboard'));
	// 	} else {
	// 		redirect(base_url('Auth'));
	// 	}
	// }
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Auth'));
	}
}

