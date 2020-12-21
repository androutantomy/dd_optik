<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("model_penjualan");
		if($this->session->userdata('status') == '') {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$this->template->load('penjualan/home');
	}

	function add($id = '0') 
	{
		$data['frame'] = $this->db->select("a.*, b.stok")->from("data_frame b")->join("master_frame a", "a.id = b.id_frame")->where("status", 2)->where("id_toko", 1)->where("b.stok >", 0)->get()->result();
		$data['lensa'] = $this->db->select("a.*, b.*, b.id AS id_data_lensa")->from("data_lensa b")->join("master_lensa a", "a.id = b.id_lensa")->where("b.stok >", 0)->get()->result();
		if($id != '0') {
			$data['penjualan'] = $this->db->select("a.*")->get_where("penjualan a", array("md5(a.id)" => $id))->row();
			$data['data_frame'] = $this->db->select("master_frame.nama AS nama_frame")->join("master_frame", "master_frame.id = data_frame.id_frame")->get_where("data_frame", array("id_frame" => $data['penjualan']->id_frame))->row();
			$data['data_lensa'] = $this->db->select("master_lensa.nama")->join("master_lensa", "master_lensa.id = data_lensa.id_lensa")->get_where("data_lensa", array("id_lensa" => $data['penjualan']->id_lensa))->row();
		}
		$data['master_lensa'] = $this->db->get("master_lensa")->result();
		$this->load->view('penjualan/transaksi', $data);
	}

	function list_data()
	{		
        $list = $this->model_penjualan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
           	
           	$no++;
			$row = array();
			$row[] = $no;
            $row[] = $field->nama;
            $row[] = date("d-m-Y", strtotime($field->tanggal_nota));
			$row[] = date("d-m-Y", strtotime($field->tgl_selesai));
			if ($field->status == 1) {
				$status = "Transaksi Baru";
			} elseif($field->status == 2) {
				$status = "Proses pesan lensa";
			} elseif($field->status == 3) {
				$status = "Lensa pesanan sampai";
			} else {
				$status = "Transaksi Selesai";
			}
			$row[] = $status;

            $button = "<button class='btn btn-sm btn-warning pelunasan' type='nota' id='". md5($field->id) ."'><i class='fa fa-money'></i> Pelunasan</button>
            			<button class='btn btn-sm btn-warning nota' type='nota' id='". md5($field->id) ."'><i class='fa fa-pencil-square'></i> Nota</button>
            			<button class='btn btn-sm btn-success nota_produksi' type='nota_produksi' id='". md5($field->id) ."'><i class='fa fa-pencil-square'></i> Nota Produksi</button>";
            if($field->status > 1 || $field->status == 0) {
            	$button .= "<button class='btn btn-sm btn-success transaksi_selesai' id='". md5($field->id) ."'><i class='fa fa-pencil-square'></i> Selesai</button>";
            }
            $row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_penjualan->count_all(),
			"recordsFiltered" => $this->model_penjualan->count_filtered(),
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
			'lsph' => $this->input->post("sphl"),
			'lcyl' => $this->input->post("cyll"),
			'laxis' => $this->input->post("axisl"),
			'ladd' => $this->input->post("addl"),
			'rsph' => $this->input->post("sphr"),
			'rcyl' => $this->input->post("cylr"),
			'raxis' => $this->input->post("axisr"),
			'radd' => $this->input->post("addr"),
			'pd_jauh' => $this->input->post("pd_jauh"),
			'pd_dekat' => $this->input->post("pd_dekat"),
			'id_frame' => $this->input->post("frame"),
			'id_lensa' => $this->input->post("lensa"),
			'keterangan' => $this->input->post("keterangan"),
			'harga_keterangan' => $this->input->post("harga_keterangan") != "" ? $this->input->post("harga_keterangan") : 0,
			'potongan_frame' => $this->input->post("harga_frame") != "" ? $this->input->post("harga_frame") : 0,
			'potongan_lensa' => $this->input->post("harga_lensa") != "" ? $this->input->post("harga_lensa") : 0,
			'harga_frame' => str_replace(".", "", $this->input->post("harga_frame_asli")) != "" ? str_replace(".", "", $this->input->post("harga_frame_asli")) : 0,
			'harga_lensa' => str_replace(".", "", $this->input->post("harga_lensa_asli")) != "" ? str_replace(".", "", $this->input->post("harga_lensa_asli"))  : 0,
			'uang_muka' => $this->input->post("uang_muka") != "" ? $this->input->post("uang_muka") : 0,
			'sisa' => str_replace(".", "", $this->input->post("sisa")) != "" ? str_replace(".", "", $this->input->post("sisa")) : 0,
			'tipe_pembelian' => $this->input->post("tipe_pembelian"),
			'tgl_selesai' => $this->input->post("tgl_selesai"),
			'is_bpjs' => $this->input->post("is_bpjs"),
			'status' => $this->input->post("pesan_lensa") == "" ? 0 : 2,

		];

		$next = $this->input->post("pesan_lensa") == "" ? "oke" : "tidak";
		$m1 = "Berhasil proses penjualan, silahkan proses pemesanan lensa";
		$m2 = "Berhasil proses pembelian";
		$m = $this->input->post("pesan_lensa") == "" ? $m1 : $m2;
		if($id == "") {
			if($this->input->post("frame") != "" && $this->input->post("frame") != "0") {
				$gF = $this->db->get_where("data_frame", array("id" => $this->input->post("frame")))->row()->stok;
				$tF = $gF - 1;
				$k = $this->db->set("stok", $tF)->where("id", $this->input->post("frame"))->update("data_frame");
			} 

			if($this->input->post("pesan_lensa") == "") {
				$gF = $this->db->get_where("data_lensa", array("id" => $this->input->post("lensa")))->row()->stok;
				$tF = $gF - 1;
				$k = $this->db->set("stok", $tF)->where("id", $this->input->post("lensa"))->update("data_lensa");
			}

			$i = $this->db->insert("penjualan", $data);
			$insert_id = md5($this->db->insert_id());
		} else {
			$i = $this->db->where("md5(id)", $id)->update("penjualan", $data);
			$insert_id = $id;
		}

		if($i) {
			$json = ['s' => 'sukses', 'm' => $m, 'url' => $insert_id, 'next' => $next];
		} else {
			$json = ['s' => 'gagal', 'm' => 'Gagal proses pembelian, silahkan coba kembali'];
		}

		echo json_encode($json);exit;
	}

	function nota($id)
	{
		$filename = "Nota Penjualan";
		$data['title'] = $filename;
		$data['pembelian'] = $this->db->select("a.*")->get_where("penjualan a", array("md5(a.id)" => $id))->row();
		$data['data_toko'] = $this->db->get_where("master_toko", array("id" => $data['pembelian']->id_toko))->row();
		$this->load->view('penjualan/nota', $data);
		/*$this->load->add_package_path(APPPATH.'third_party/dompdf/');		
		require_once(APPPATH."third_party/dompdf/dompdf_config.inc.php");


		$name   = "Nota Penjualan.pdf";
		$dompdf = new Dompdf();
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'landscape');
		$dompdf->render();
		return $dompdf->stream($name,array("Attachment"=>0));*/

	}

	function nota_produksi($id)
	{
		$filename = "Nota Produksi";
		$data['title'] = $filename;
		$data['pembelian'] = $this->db->select("a.*")->get_where("penjualan a", array("md5(a.id)" => $id))->row();
		$data['data_toko'] = $this->db->get_where("master_toko", array("id" => $data['pembelian']->id_toko))->row();
		$this->load->view('penjualan/nota_produksi', $data);
		/*$data['gambar_toko'] = $this->convertion->get_gambar_optik($data['pembelian']->id_toko);
		$data['alamat'] = $this->convertion->data_optik("alamat", $data['pembelian']->id_toko);
		$data['nama_toko'] = $this->convertion->data_optik("nama_toko", $data['pembelian']->id_toko);
		$data['telp'] = $this->convertion->data_optik("telp", $data['pembelian']->id_toko);
		
		$this->load->add_package_path(APPPATH.'third_party/dompdf/');		
		require_once(APPPATH."third_party/dompdf/dompdf_config.inc.php");


		$name   = "Nota Produksi.pdf";
		$dompdf = new Dompdf();
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'potrait');
		$dompdf->render();
		return $dompdf->stream($name,array("Attachment"=>0));*/
	}

	function cairan()
	{
		$this->load->view("penjualan/jual_barang");
	}

	function transaksi_selesai($id)
	{
		$u = $this->db->set("status", 1)->where("md5(id)", $id)->update("penjualan");

		if($u) {
			$json = ['s' => 'sukses', 'm' => 'Transaksi selesai'];
		} else {
			$json = ['s' => 'gagal', 'm' => 'Upps, terjadi kesalahan, Silahkan coba lagi'];
		}

		echo json_encode($json);exit;
	}

	function simpan_transaksi()
	{
		$data = [
			''
		];
	}

}
