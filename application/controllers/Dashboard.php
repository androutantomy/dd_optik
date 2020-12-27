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
		$this->db->select("penjualan.*")->from("penjualan");
		if($this->session->userdata("id_level") != 3) {
			$this->db->where("id_toko", $this->session->userdata("id_toko"));
		}
		$this->db->order_by("tanggal_nota", "desc");
		$listnya = $this->db->limit(4)->get()->result();


		$this->db->select("penjualan_barang.*")->from("penjualan_barang");
		if($this->session->userdata("id_level") != 3) {
			$this->db->where("id_toko", $this->session->userdata("id_toko"));
		}
		$this->db->order_by("tgl_transaksi", "desc");
		$listnya2 = $this->db->limit(4)->get()->result();

		$data['listnya'] = $listnya;
		$data['listnya2'] = $listnya2;
		$this->template->load('dashboard', $data);
	}
}
