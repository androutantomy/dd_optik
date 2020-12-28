<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct(){
		parent::__construct();		

		if($this->session->userdata('status') == ''){
			redirect(base_url('auth'));
		}
		$this->load->model("model_laporan");
	}

	public function index()
	{	
		$id_toko = "-";
		$start = "-";
		$end = "-";

		if($this->input->get('toko') != '') {
			$id_toko = $this->input->get("toko");
		}
		if($this->input->get('tgl_mulai') != '') {
			$start = $this->input->get("tgl_mulai");
		}
		if($this->input->get('tgl_selesai') != '') {
			$end = $this->input->get("tgl_selesai");
		}

		if($this->input->get("submit") == 'download') {
			$this->download_excel($id_toko, $start, $end);
		}

		$data['id_toko'] = $id_toko;
		$data['start'] = $start;
		$data['end'] = $end;

		$data['toko'] = $this->db->get("master_toko")->result();
		$this->template->load("laporan/home", $data);
	}

	function download_excel($id_toko, $start, $end)
	{
		$data['listnya'] = $this->model_laporan->get_dataexcel($id_toko, $start, $end);
		$this->load->view("laporan/excel", $data);
	}

	function download_excel_cairan($id_toko, $start, $end)
	{
		$data['listnya'] = $this->model_laporan->get_dataexcel_cairan($id_toko, $start, $end);
		$this->load->view("laporan/excel_cairan", $data);
	}

	function list_data($id_toko="-", $start="-", $end="-")
	{		
        $list = $this->model_laporan->get_datatables($id_toko, $start, $end);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
           	
           	$no++;
			$row = array();
			$row[] = $no;
			$nama_toko = "";
			if($field->id_toko != 0) {
				$nama_toko = $this->db->get_where("master_toko", array("id" => $field->id_toko))->row()->nama_toko;
			}
            $row[] = $nama_toko;
            $row[] = $field->nama;
            $row[] = $field->nama_frame;
            $row[] = $field->nama_lensa;
            $row[] = date("d-m-Y", strtotime($field->tanggal_nota));
			$row[] = "Rp. ".number_format($field->harga_keterangan+$field->harga_frame+$field->harga_lensa);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_laporan->count_all(),
			"recordsFiltered" => $this->model_laporan->count_filtered($id_toko, $start, $end),
			"data" => $data,
        );
        
		echo json_encode($output);
    
	}

	function list_data_cairan($id_toko="-", $start="-", $end="-")
	{		
        $list = $this->model_laporan->get_datatables2($id_toko, $start, $end);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
           	
           	$no++;
			$row = array();
			$row[] = $no;
			$nama_toko = "";
			if($field->id_toko != 0) {
				$nama_toko = $this->db->get_where("master_toko", array("id" => $field->id_toko))->row()->nama_toko;
			}
            $row[] = $nama_toko;
            $row[] = $field->id_jenis == 1 ? "Cairan" : "Softlense";
            $row[] = $field->nama;
            $row[] = $field->nama_barang;
            $row[] = date("d-m-Y", strtotime($field->tgl_transaksi));
			$row[] = "Rp. ".number_format($field->nominal);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_laporan->count_all2(),
			"recordsFiltered" => $this->model_laporan->count_filtered2($id_toko, $start, $end),
			"data" => $data,
        );
        
		echo json_encode($output);
    
	}

}