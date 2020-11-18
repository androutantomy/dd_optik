<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_data extends CI_Controller {

  public function __construct(){
    parent ::__construct();

  }

  // master jenis barang
  function data_jenis_barang()
  {
    $data['barang'] = $this->db->get("master_jenis_barang")->result();
    $data['atv'] = 'jenis_barang';

    $this->template->load("master/list_jenis_barang", $data);
  }

  function simpan_jenis_barang()
  {
    $i = $this->db->set("nama_kategori", $this->input->post('nama'))->insert("master_jenis_barang");

    if($i) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil simpan data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal simpan data'];
    }

    echo json_encode($json);exit;
  }

  function get_data_jenis($id)
  {
    $g = $this->db->get_where("master_jenis_barang", array("md5(id)" => $id))->row();

    if($g) {
      $json = ['s' => 'sukses', 'nama' => $g->nama_kategori, 'id' => $g->id];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal simpan data'];
    }

    echo json_encode($json);exit;
  }

  function update_jenis_barang()
  {
    $i = $this->db->set("nama_kategori", $this->input->post('nama_edit'))->where('id', $this->input->post('id'))->update("master_jenis_barang");

    if($i) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil update data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal update data'];
    }

    echo json_encode($json);exit;
  }

  function hapus_jenis_barang($id)
  {
    $d = $this->db->where("md5(id)", $id)->delete("master_jenis_barang");

    if($d) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil hapus data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal hapus data'];
    }

    echo json_encode($json);exit;
  }

}