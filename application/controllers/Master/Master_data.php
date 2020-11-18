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

    $this->template->load("master/list_jenis_barang", $data);
  }

  function simpan_jenis_barang($jenis)
  {
    if($jenis == 'jenis_barang') {
      $i = $this->db->set("nama_kategori", $this->input->post('nama'))->insert("master_jenis_barang");
    } elseif($jenis == 'frame') {
      $i = $this->db->set("nama", $this->input->post('nama'))->insert("master_frame");
    } elseif($jenis == 'cairan') {
      $i = $this->db->set("nama", $this->input->post('nama'))->insert("master_cairan");
    }

    if($i) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil simpan data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal simpan data'];
    }

    echo json_encode($json);exit;
  }

  function get_data_jenis($jenis, $id)
  {
    if($jenis == 'jenis_barang') {
      $g = $this->db->get_where("master_jenis_barang", array("md5(id)" => $id))->row();
      $nama = $g->nama_kategori;
    } elseif ($jenis == 'frame') {
      $g = $this->db->get_where("master_frame", array("md5(id)" => $id))->row();
      $nama = $g->nama;
    } elseif ($jenis == 'cairan') {
      $g = $this->db->get_where("master_cairan", array("md5(id)" => $id))->row();
      $nama = $g->nama;
    }

    if($g) {
      $json = ['s' => 'sukses', 'nama' => $nama, 'id' => $g->id];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal simpan data'];
    }

    echo json_encode($json);exit;
  }

  function update_jenis_barang($jenis)
  {
    if($jenis == 'jenis_barang') {
      $i = $this->db->set("nama_kategori", $this->input->post('nama_edit'))->where('id', $this->input->post('id'))->update("master_jenis_barang");
    } elseif($jenis == 'frame') {
      $i = $this->db->set("nama", $this->input->post('nama_edit'))->where('id', $this->input->post('id'))->update("master_frame");
    } elseif($jenis == 'cairan') {
      $i = $this->db->set("nama", $this->input->post('nama_edit'))->where('id', $this->input->post('id'))->update("master_cairan");
    }

    if($i) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil update data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal update data'];
    }

    echo json_encode($json);exit;
  }

  function hapus_jenis_barang($jenis, $id)
  {
    if($jenis == 'jenis_barang') {
      $d = $this->db->where("md5(id)", $id)->delete("master_jenis_barang");
    } elseif($jenis == 'frame') {
      $d = $this->db->where("md5(id)", $id)->delete("master_frame");
    } elseif($jenis == 'cairan') {
      $d = $this->db->where("md5(id)", $id)->delete("master_cairan");
    }

    if($d) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil hapus data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal hapus data'];
    }

    echo json_encode($json);exit;
  }

  // master frame
  function data_frame()
  {
    $data['barang'] = $this->db->get("master_frame")->result();

    $this->template->load("master/list_frame", $data);
  }

  // master cairan
  function data_cairan()
  {
    $data['barang'] = $this->db->get("master_cairan")->result();

    $this->template->load("master/list_cairan", $data);
  }
}