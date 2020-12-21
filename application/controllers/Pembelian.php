<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("model_pembelian");
		if($this->session->userdata('status') == '') {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$this->template->load('pembelian/home');
	}

	function add($id = '0') 
	{
		$data['frame'] = $this->db->select("a.*, b.stok")->from("data_frame b")->join("master_frame a", "a.id = b.id_frame")->where("status", 2)->where("id_toko", 1)->where("b.stok >", 0)->get()->result();
		$data['lensa'] = $this->db->select("a.*, b.*, b.id AS id_data_lensa")->from("data_lensa b")->join("master_lensa a", "a.id = b.id_lensa")->where("b.stok >", 0)->get()->result();
		if($id != '0') {
			$data['penjualan'] = $this->db->select("a.*, d.nama AS nama_frame, e.nama")->join("data_frame b", "a.id_frame = b.id")->join("data_lensa c", "a.id_lensa = c.id")
										->join("master_frame d", "b.id_frame = d.id")->join("master_lensa e", "c.id_lensa = e.id")
										->get_where("penjualan a", array("md5(a.id)" => $id))->row();
		}
		$this->load->view('pembelian/transaksi', $data);
	}

	function list_data()
	{		
        $list = $this->model_pembelian->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
           	
           	$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama;
			$row[] = date("d-m-Y", strtotime($field->tanggal_nota));
            $row[] = "<button class='btn btn-sm btn-warning pelunasan' type='nota' id='". md5($field->id) ."'><i class='fa fa-money'></i> Pelunasan</button>
            			<button class='btn btn-sm btn-warning nota' type='nota' id='". md5($field->id) ."'><i class='fa fa-pencil-square'></i> Nota</button>
            			<button class='btn btn-sm btn-success nota_produksi' type='nota_produksi' id='". md5($field->id) ."'><i class='fa fa-pencil-square'></i> Nota Produksi</button>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_pembelian->count_all(),
			"recordsFiltered" => $this->model_pembelian->count_filtered(),
			"data" => $data,
        );
        
		echo json_encode($output);
    
	}

	function simpan_data($id = '')
	{
		$data = [
			'nama' => $this->input->post("nama"),
			'alamat' => $this->input->post("alamat"),
			'telp' => $this->input->post("telp"),
			'id_frame' => $this->input->post("frame"),
			'id_lensa' => $this->input->post("lensa"),
			'harga_frame' => str_replace(".", "", $this->input->post("harga_frame_asli")),
			'harga_lensa' => str_replace(".", "", $this->input->post("harga_lensa_asli")),
			'tipe_pembelian' => $this->input->post("tipe_pembelian"),

		];
		$next = $this->input->post("pesan_lensa") == "" ? "oke" : "tidak";
		$m1 = "Berhasil proses pembelian, silahkan cek data barang";
		$m2 = "Berhasil proses pembelian";
		$m = $this->input->post("pesan_lensa") == "" ? $m1 : $m2;

		if($id == "") {
			if($this->input->post("frame") != "" && $this->input->post("frame") != "0") {
			$gF = $this->db->get_where("data_frame", array("id" => $this->input->post("frame")))->row()->stok;
			$tF = $gF + 1;
			$k = $this->db->set("stok", $tF)->where("id", $this->input->post("frame"))->update("data_frame");

		}if($this->input->post("pesan_lensa") == "") {
			$gF = $this->db->get_where("data_lensa", array("id" => $this->input->post("lensa")))->row()->stok;
			$tF = $gF + 1;
			$k = $this->db->set("stok", $tF)->where("id", $this->input->post("lensa"))->update("data_lensa");
		}
			// print_r($data);exit;
			$i = $this->db->insert("pembelian", $data);
			$insert_id = md5($this->db->insert_id());
		} else {
			$i = $this->db->where("md5(id)", $id)->update("pembelian", $data);
			$insert_id = $id;
		}

		if($i) {
			$json = ['s' => 'sukses', 'm' => 'Berhasil proses pembelian', 'url' => $insert_id];
		} else {
			$json = ['s' => 'gagal', 'm' => 'Gagal proses pembelian, silahkan coba kembali'];
		}

		echo json_encode($json);exit;
	}

	function nota($id)
	{
		$filename = "Nota Pembelian";
		$data['title'] = $filename;
		$data['pembelian'] = $this->db->select("a.*, d.nama AS nama_frame, e.nama")->join("data_frame b", "a.id_frame = b.id")->join("data_lensa c", "a.id_lensa = c.id")
										->join("master_frame d", "b.id_frame = d.id")->join("master_lensa e", "c.id_lensa = e.id")
										->get_where("pembelian a", array("md5(a.id)" => $id))->row();
		// echo "<pre>"; print_r($data['pembelian']->nama);exit;
		$html = $this->load->view('pembelian/nota', $data, true);
		$this->load->add_package_path(APPPATH.'third_party/dompdf/');		
		require_once(APPPATH."third_party/dompdf/dompdf_config.inc.php");


		$name   = "Nota Pembelian.pdf";
		$dompdf = new Dompdf();
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'landscape');
		$dompdf->render();
		return $dompdf->stream($name,array("Attachment"=>0));

	}

	function nota_produksi($id)
	{
		$filename = "Nota Produksi";
		$data['title'] = $filename;
		$data['pembelian'] = $this->db->select("a.*, d.nama AS nama_frame, e.nama")->join("data_frame b", "a.id_frame = b.id")->join("data_lensa c", "a.id_lensa = c.id")
										->join("master_frame d", "b.id_frame = d.id")->join("master_lensa e", "c.id_lensa = e.id")
										->get_where("pembelian a", array("md5(a.id)" => $id))->row();
		// echo "<pre>"; print_r($data['pembelian']->nama);exit;
		$html = $this->load->view('pembelian/nota_produksi', $data, true);
		$this->load->add_package_path(APPPATH.'third_party/dompdf/');		
		require_once(APPPATH."third_party/dompdf/dompdf_config.inc.php");


		$name   = "Nota Produksi.pdf";
		$dompdf = new Dompdf();
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'potrait');
		$dompdf->render();
		return $dompdf->stream($name,array("Attachment"=>0));
	}

}
