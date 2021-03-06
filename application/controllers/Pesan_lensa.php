<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_lensa extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("model_pesan");
		if($this->session->userdata('status') == '') {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$this->template->load('pembelian/pesan_lensa');
	}

	function pesan($id)
	{
		$data['master_lensa'] = $this->db->get("master_lensa")->result();
		$this->template->load('pembelian/form_pesan_lensa', $data);
	}

	function list_data()
	{		
        $list = $this->model_pesan->get_datatables();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $field) {
           	
           	$no++;
			$row = array();
			$row[] = $no;
            $row[] = $field->nama;
            $row[] = "<button class='btn btn-sm btn-warning selesai' type='nota' id='". md5($field->id) ."'><i class='fa fa-money'></i> Pesanan sampai</button>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_pesan->count_all(),
			"recordsFiltered" => $this->model_pesan->count_filtered(),
			"data" => $data,
        );
        
		echo json_encode($output);
    
	}

	function simpan_data()
	{
		$g = $this->db->get_where("penjualan", array("md5(id)" => $this->input->post("id_pesanan")))->row();

		$dataL = [
			'id_pesanan' => $g->id,
			'jenis_mata' => $this->input->post("jenis_mata"),
			'nama_lensa' => $this->input->post("jenis_barangl") == 2 ? $this->input->post("nama_lensal") : "-",
			'jenis_barang' => $this->input->post("jenis_barangl"),
			'tipe_lensa' => $this->input->post("tipe_lensal"),
			'harga_beli' =>$this->input->post("harga_belil"),
			'harga_jual' => $this->input->post("harga_juall"),
			'jumlah' => 1,
			'type_lensa' => $this->input->post("type_lensal"),
			'plus_minus' => $this->input->post("minusl")."|".$this->input->post("plusl"),
			'sph' => $this->input->post("sphl"),
			'cyl' => $this->input->post("cyll"),
			'addl' => $this->input->post("addl"),
			'id_lensa' => $this->input->post("jenis_barangl") == 1 ? $this->input->post("lensal") : 0,
			'status' => 0
		];

		$i = $this->db->insert("pesan_lensa", $dataL);

		if($i) {
			$json = ['s' => 'sukses', 'm' => 'Berhasil buat pesanan lensa'];
		} else {
			$json = ['s' => 'gagal', 'm' => 'Upps, Gagal buat pesanan lensa'];
		}

		echo json_encode($json);exit;
	}

	function cek_lensa($id)
	{
		$g = $this->db->get_where("master_lensa", array("id" => $id))->row()->nama;

		$nama = $g != "" ? $g : "";

		return $nama;
	}

	function selesai($id)
	{
		$g = $this->db->get_where("pesan_lensa", array('md5(id)' => $id))->row();

		if($i) {
			$u = $this->db->set("status", 3)->where("id", $g->id_pesanan)->update("penjualan");
			if($u) {
				$d = $this->db->set("status", 1)->where("id", $g->id)->update("pesan_lensa");
			}			
			$json = ['s' => 'sukses', 'm' => 'Berhasil update status transaksi'];
		} else {
			$json = ['s' => 'gagal', 'm' => 'Gagal update status transaksi'];
		}

		echo json_encode($json);exit;
	}
}