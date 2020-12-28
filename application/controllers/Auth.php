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
		$cek_u = $this->db->get_where("user", ['username' => $username])->num_rows();

		$cek_p = $this->db->get_where("user", ['password' => $password])->num_rows();

		$cek_login = $this->m_login->cek_login($username,$password);

		if($cek_u == 0) {
			$data = [
				'status' => 'gagal',
				'message' => 'Username anda salah',
			];

			$this->session->set_flashdata($data);
			redirect(base_url());
		}

		if($cek_p == 0) {
			$data = [
				'status' => 'gagal',
				'message' => 'Password anda salah',
			];
			$this->session->set_flashdata($data);
			redirect(base_url());
		}


		if($cek_login->num_rows() > 0){
 
			$data_session = array(
				'nama_lengkap' => $cek_login->row()->nama_lengkap,
				'id_toko' => $cek_login->row()->id_toko,
				'id_level' => $cek_login->row()->id_level,			
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("Dashboard"));
 
		} else {
			$data = [
				'status' => 'gagal',
				'message' => 'Gagal login, periksa kembali Username dan Password anda',
			];
			$this->session->set_flashdata($data);
			redirect(base_url());
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Auth'));
	}
}

