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
}