<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Convertion {
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance(); 
	}

	function cek_frame($id_frame, $status, $jenis, $toko) {
	    if($jenis == "frame") {
	      	$cek = $this->ci->db->get_where("data_frame", array("id_frame" => $id_frame, "status" => $status));
	    } elseif($jenis == "cairan") {
	      	$cek = $this->ci->db->get_where("data_cairan", array("id_cairan" => $id_frame, "status" => $status));
	    }
	    $stok = [];

	    if($cek->num_rows() > 0) {
	      	$stok['stok'] = $cek->row()->stok;
	      	$stok['id'] = $cek->row()->id;
	    } else {
	      	$stok['stok'] = 0;
	    }

	    return $stok;
	}

	function nama_barang($tipe, $id) 
	{
		$g = $this->ci->db->select("master_".$tipe.".nama")->join("master_".$tipe, "master_".$tipe.".id = data_".$tipe.".id_".$tipe."")->get_where("data_".$tipe, array("data_".$tipe.".id" => $id));
		
		return $g->num_rows() > 0 ? $g->row()->nama : "-";
	}

	function get_gambar_optik($id)
	{
		$g = $this->ci->db->get_where("master_toko", array("id" => $id))->row();

		if($g != "") {
			$logo = $g->logo;
		} else {
			$logo = base_url()."uploads/logo/_173431.png";
		}

		return $logo;
	}

	function data_optik($tipe, $id)
	{
		$g = $this->ci->db->get_where("master_toko", array("id" => $id))->row();

		if($g != "") {
			return $g->$tipe;
		} else {
			return "-";
		}
	}
}