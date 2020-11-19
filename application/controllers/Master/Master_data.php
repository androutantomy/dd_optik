<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_data extends CI_Controller {

  public function __construct(){
    parent ::__construct();
    $this->load->model("model_frame");
    $this->load->model("model_lensa");
    $this->load->model("model_cairan");

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

  function data_gudang()
  {
    // $data['barang'] = $this->db->get("master_cairan")->result();

    $this->template->load("master/data_gudang"); 
  }

  function input_gudang()
  {
    $this->load->view("master/gudang");
  }

  function option_frame($id = '')
  {
    $g = $this->db->get("master_frame")->result();

    $arr = ["Pilih Frame"];
    foreach($g as $val) {
      $arr[$val->id] = $val->nama;
    }

    $option = form_dropdown("frame", $arr, '', array("class" => "form-control form-control-sm", "id" => "frame", "required" => "required"));

    $json = ['s' => 'sukses', 'option' => $option];

    echo json_encode($json);exit;

  }

  function option_lensa($id = '')
  {
    $g = $this->db->get("master_lensa")->result();

    $arr = ["Pilih Lensa"];
    foreach($g as $val) {
      $arr[$val->id] = $val->nama_lensa;
    }

    $option = form_dropdown("lensa", $arr, '', array("class" => "form-control form-control-sm", "id" => "lensa", "required" => "required"));

    $json = ['s' => 'sukses', 'option' => $option];

    echo json_encode($json);exit;

  }

  function option_cairan($id = '')
  {
    $g = $this->db->get("master_cairan")->result();

    $arr = ["Pilih Cairan"];
    foreach($g as $val) {
      $arr[$val->id] = $val->nama;
    }

    $option = form_dropdown("cairan", $arr, '', array("class" => "form-control form-control-sm", "id" => "cairan", "required" => "required"));

    $json = ['s' => 'sukses', 'option' => $option];

    echo json_encode($json);exit;

  }

  function simpan_data_gudang()
  {
    if($this->input->post("jenis") == 1) {
      $status = $this->cek_frame($this->input->post("frame"), 1, "frame");

      $data = [
        "id_frame" => $this->input->post("frame"),
        "status" => 1,
        "id_toko" => 0,
        "stok" => $status["stok"] > 0 ? $this->input->post("stok") + $status["stok"] : $this->input->post("stok"),
      ];
    } elseif($this->input->post("jenis") == 2) {
      $status = $this->cek_frame($this->input->post("lensa"), 1, $this->input->post("min").",".$this->input->post("min"), $this->input->post("type"));
      $data = [
        "id_lensa" => $this->input->post("lensa"),
        "status" => 1,
        "id_toko" => 0,
        "stok" => $status["stok"] > 0 ? $this->input->post("stok") + $status["stok"] : $this->input->post("stok"),
        "min_max" => $this->input->post("min").",".$this->input->post("min"),
        "type_lensa" => $this->input->post("type"),
      ];
    } else {
      $status = $this->cek_frame($this->input->post("cairan"), 1, "cairan");
      $data = [
        "id_cairan" => $this->input->post("cairan"),
        "status" => 1,
        "id_toko" => 0,
        "stok" => $status["stok"] > 0 ? $this->input->post("stok") + $status["stok"] : $this->input->post("stok"),
      ];
    }

    if($this->input->post("jenis") == 1) {
      if($status["stok"] < 0 ) {        
        $i = $this->db->insert("data_frame", $data);
      } else {
        $i = $this->db->where("id", $status["id"])->update("data_frame", $data);
      }
    } elseif($this->input->post("jenis") == 2) {
      if($status["stok"] < 0 ) {   
        $i = $this->db->insert("data_lensa", $data);
      } else {
        $i = $this->db->where("id", $status["id"])->update("data_lensa", $data);
      }
    } else {
      if($status["stok"] < 0 ) {   
        $i = $this->db->insert("data_cairan", $data);
      } else {
        $i = $this->db->where("id", $status["id"])->update("data_cairan", $data);
      }
    }

    if($i) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil simpan data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal simpan data'];
    }

    echo json_encode($json);exit;
  }

  function cek_frame($id_frame, $status, $jenis) {
    if($jenis == "frame") {
      $cek = $this->db->get_where("data_frame", array("id_frame" => $id_frame, "status" => $status));
    } elseif($jenis == "cairan") {
      $cek = $this->db->get_where("data_cairan", array("id_cairan" => $id_frame, "status" => $status));
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

  function cek_lensa($id_lensa, $status, $min_max, $type_lensa) {
    $cek = $this->db->get_where("data_lensa", array("id_lensa" => $id_frame, "status" => $status, "min_max" => $min_max, "type_lensa" => $type_lensa));
    $stok = [];


    if($cek->num_rows() > 0) {
      $stok['stok'] = $cek->row()->stok;
      $stok['id'] = $cek->row()->id;
    } else {
      $stok['stok'] = 0;
    }

    return $stok;
  }

  function list_data_frame()
  {
    $this->load->view("gudang/list_frame");
  }

  function list_data_lensa()
  {
    $this->load->view("gudang/list_lensa");
  }

  function list_data_cairan()
  {
    $this->load->view("gudang/list_cairan");
  }

  function ajax_list_frame()
  {
    $list = $this->model_frame->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {

      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->nama;
      $row[] = $field->stok;
      $row[] = "";
      $row[] = "";
      $row[] = "";
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->model_frame->count_all(),
      "recordsFiltered" => $this->model_frame->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function ajax_list_lensa()
  {
    $list = $this->model_lensa->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {

      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->nama_lensa;
      $row[] = $field->stok;
      $row[] = "";
      $row[] = "";
      $row[] = "";
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->model_lensa->count_all(),
      "recordsFiltered" => $this->model_lensa->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function ajax_list_cairan()
  {
    $list = $this->model_cairan->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {

      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->nama;
      $row[] = $field->stok;
      $row[] = "";
      $row[] = "";
      $row[] = "";
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->model_cairan->count_all(),
      "recordsFiltered" => $this->model_cairan->count_filtered(),
      "data" => $data,
    );

    echo json_encode($output);
  }
}