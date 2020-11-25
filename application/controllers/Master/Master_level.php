<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_level extends CI_Controller {

  public function __construct(){
    parent ::__construct();
    // $this->load->model("model_level");

  }

  // master jenis level
  function data_jenis_level()
  {
    $data['level_user'] = $this->db->get("master_user_level")->result();

    $this->template->load("level_user/list", $data);
  }

  function simpan_jenis_level($jenis)
  {
    if($jenis == 'jenis_level') {
      $i = $this->db->set("nama_level", $this->input->post('nama'))->insert("master_user_level");
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
    if($jenis == 'jenis_level') {
      $g = $this->db->get_where("master_user_level", array("md5(id)" => $id))->row();
      $nama = $g->nama_level;
    } 

    if($g) {
      $json = ['s' => 'sukses', 'nama' => $nama, 'id' => $g->id];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal simpan data'];
    }

    echo json_encode($json);exit;
  }

  function update_jenis_level($jenis)
  {
    if($jenis == 'jenis_level') {
      $i = $this->db->set("nama_level", $this->input->post('nama_edit'))->where('id', $this->input->post('id'))->update("master_user_level");
    }

    if($i) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil update data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal update data'];
    }

    echo json_encode($json);exit;
  }

  function hapus_jenis_level($jenis, $row)
  {
    if($jenis == 'jenis_level') {
      $d = $this->db->where("md5(id)", $row)->delete("master_user_level");
    } 


    if($d) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil hapus data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal hapus data'];
    }

    echo json_encode($json);exit;
  }
}