<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_data extends CI_Controller {

  public function __construct(){
    parent ::__construct();
    $this->load->model("model_frame");
    $this->load->model("model_lensa");
    $this->load->model("model_cairan");
    $this->load->model("model_softlense");

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
      $i = $this->db->set("nama", $this->input->post('nama'))->set("harga_beli", $this->input->post("harga_beli"))->set("harga_jual", $this->input->post("harga_jual"))->insert("master_frame");
    } elseif($jenis == 'cairan') {
      $i = $this->db->set("nama", $this->input->post('nama'))->set("harga_beli", $this->input->post("harga_beli"))->set("harga_jual", $this->input->post("harga_jual"))->insert("master_cairan");
    } elseif($jenis == 'lensa') {
      $i = $this->db->set("nama", $this->input->post('nama'))->set("harga_beli", $this->input->post("harga_beli"))->set("harga_jual", $this->input->post("harga_jual"))->insert("master_lensa");
    } elseif($jenis == 'softlense'){
      $i = $this->db->set("nama", $this->input->post('nama'))->set("harga_beli", $this->input->post("harga_beli"))->set("harga_jual", $this->input->post("harga_jual"))->insert("master_softlense");
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
    $tipe = "";
    if($jenis == 'jenis_barang') {
      $g = $this->db->get_where("master_jenis_barang", array("md5(id)" => $id))->row();
      $nama = $g->nama_kategori;
    } elseif ($jenis == 'frame') {
      $g = $this->db->get_where("master_frame", array("md5(id)" => $id))->row();
      $nama = $g->nama;
    } elseif ($jenis == 'cairan') {
      $g = $this->db->get_where("master_cairan", array("md5(id)" => $id))->row();
      $nama = $g->nama;
    } elseif ($jenis == 'lensa') {
      $g = $this->db->get_where("master_lensa", array("md5(id)" => $id))->row();
      $nama = $g->nama;
      $tipe = $g->tipe_lensa;
    } elseif($jenis == 'softlense') {
       $g = $this->db->get_where("master_softlense", array("md5(id)" => $id))->row();
      $nama = $g->nama;
    }

    if($g) {
      $json = ['s' => 'sukses', 'nama' => $nama, 'id' => $g->id, 'harga_jual' => $g->harga_jual, 'harga_beli' => $g->harga_beli, 'tipe' => $tipe];
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
      $i = $this->db->set("nama", $this->input->post('nama_edit'))->where('id', $this->input->post('id'))->set("harga_beli", $this->input->post("harga_beli_edit"))->set("harga_jual", $this->input->post("harga_jual_edit"))->update("master_frame");
    } elseif($jenis == 'cairan') {
      $i = $this->db->set("nama", $this->input->post('nama_edit'))->where('id', $this->input->post('id'))->set("harga_beli", $this->input->post("harga_beli_edit"))->set("harga_jual", $this->input->post("harga_jual_edit"))->update("master_cairan");
    } elseif($jenis == 'lensa') {
      $i = $this->db->set("tipe_lensa", $this->input->post("tipe_lensa_edit"))->set("nama", $this->input->post('nama_edit'))->where('id', $this->input->post('id'))->set("harga_beli", $this->input->post("harga_beli_edit"))->set("harga_jual", $this->input->post("harga_jual_edit"))->update("master_lensa");
    } elseif($jenis == 'softlense') {
      $i = $this->db->set("nama", $this->input->post('nama_edit'))->where('id', $this->input->post('id'))->set("harga_beli", $this->input->post("harga_beli_edit"))->set("harga_jual", $this->input->post("harga_jual_edit"))->update("master_softlense");
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
    } elseif($jenis == 'lensa') {
      $d = $this->db->where("md5(id)", $id)->delete("master_lensa");
    } elseif($jenis == 'softlense') {
      $d = $this->db->where("md5(id)", $id)->delete("master_softlense");
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

  // master lensa
  function data_lensa()
  {
    $data['barang'] = $this->db->get("master_lensa")->result();

    $this->template->load("master/list_lensa", $data);
  }

  function data_gudang($id_toko = '')
  {
    // $data['barang'] = $this->db->get("master_cairan")->result();

    $this->template->load("master/data_gudang"); 
  }

  function data_softlense($id_toko = "")
  {
    $data['barang'] = $this->db->get("master_softlense")->result();

    $this->template->load("master/list_softlense", $data);
  }

  function input_gudang($type = "", $id = "")
  {
    $data['type'] = $type;
    $data['id'] = $id;
    if($id != '') {
      if($type == "frame") {
        $data['data'] = $this->db->get_where("data_frame", array("md5(id)" => $id))->row();
      } else if($type == "lensa") {
        $data['data'] = $this->db->get_where("data_lensa", array("md5(id)" => $id))->row();
      } else {
        $data['data'] = $this->db->get_where("data_cairan", array("md5(id)" => $id))->row();
      }
    }

    $this->load->view("master/gudang", $data);
  }

  function option_frame($id = '')
  {
    $g = $this->db->get("master_frame")->result();

    $arr = ["Pilih Frame"];
    foreach($g as $val) {
      $arr[$val->id] = $val->nama;
    }

    $option = form_dropdown("frame", $arr, '', array("class" => "form-control form-control-sm select2option", "id" => "frame", "required" => "required"));

    $json = ['s' => 'sukses', 'option' => $option];

    echo json_encode($json);exit;

  }

  function option_lensa($id = '')
  {
    $g = $this->db->get("master_lensa")->result();

    $arr = ["Pilih Lensa"];
    foreach($g as $val) {
      $arr[$val->id] = $val->nama;
    }

    $option = form_dropdown("lensa", $arr, '', array("class" => "form-control form-control-sm select2option", "id" => "lensa", "required" => "required"));

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

    $option = form_dropdown("cairan", $arr, '', array("class" => "form-control form-control-sm select2option", "id" => "cairan", "required" => "required"));

    $json = ['s' => 'sukses', 'option' => $option];

    echo json_encode($json);exit;

  }

  function option_softlense($id = "") 
  {
    $g = $this->db->get("master_softlense")->result();

    $arr = ["Pilih Softlense"];
    foreach($g as $val) {
      $arr[$val->id] = $val->nama;
    }

    $option = form_dropdown("softlense", $arr, '', array("class" => "form-control form-control-sm select2option", "id" => "softlense", "required" => "required"));

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
      /*if($this->input->post("type") == 1) {
        $minMax_val = $this->input->post("minus");
      } elseif($this->input->post("type") == 2) {
        $minMax_val = $this->input->post("plus");
      } else {
        $minMax_val = $this->input->post("minus")."|".$this->input->post("plus");
      }*/
      $sph = $this->input->post("sph") != "" ? $this->input->post("sph") : "-";
      $cyl = $this->input->post("cyl") != "" ? $this->input->post("cyl") : "-";
      $add = $this->input->post("add") != "" ? $this->input->post("add") : "-";


      $status = $this->cek_lensa($this->input->post("lensa"), 1, $this->input->post("type"), $sph, $cyl, $add);
      $data = [
        "id_lensa" => $this->input->post("lensa"),
        "status" => 1,
        "id_toko" => 0,
        "stok" => $status["stok"] > 0 ? $this->input->post("stok") + $status["stok"] : $this->input->post("stok"),
        // "min_max" => $minMax_val,
        "type_lensa" => $this->input->post("type"),
        "sph" => $this->input->post("sph") != "" ? $this->input->post("sph") : "-",
        "cyl" => $this->input->post("cyl") != "" ? $this->input->post("cyl") : "-",
        "addl" => $this->input->post("add") != "" ? $this->input->post("add") : "-",
      ];
    } elseif($this->input->post("jenis") == 3) {
      $status = $this->cek_frame($this->input->post("cairan"), 1, "cairan");
      $data = [
        "id_cairan" => $this->input->post("cairan"),
        "status" => 1,
        "id_toko" => 0,
        "stok" => $status["stok"] > 0 ? $this->input->post("stok") + $status["stok"] : $this->input->post("stok"),
        "expired" => date('Y-m-d', strtotime($this->input->post("expired"))),
      ];
    } else {
      $sph = $this->input->post("sph") != "" ? $this->input->post("sph") : "-";
      $cyl = $this->input->post("cyl") != "" ? $this->input->post("cyl") : "-";
      $add = $this->input->post("add") != "" ? $this->input->post("add") : "-";


      $status = $this->cek_softlense($this->input->post("softlense"), 1, $sph, $cyl, $add);
      $data = [
        "id_softlense" => $this->input->post("softlense"),
        "status" => 1,
        "id_toko" => 0,
        "stok" => $status["stok"] > 0 ? $this->input->post("stok") + $status["stok"] : $this->input->post("stok"),
        "sph" => $this->input->post("sph") != "" ? $this->input->post("sph") : "-",
        "cyl" => $this->input->post("cyl") != "" ? $this->input->post("cyl") : "-",
        "addl" => $this->input->post("add") != "" ? $this->input->post("add") : "-",
        "expired" => date('Y-m-d', strtotime($this->input->post("expired"))),
      ];
    }

    if($this->input->post("jenis") == 1) {
      if($status["stok"] <= 0 ) {        
        $i = $this->db->insert("data_frame", $data);
      } else {
        $i = $this->db->where("id", $status["id"])->update("data_frame", $data);
      }
    } elseif($this->input->post("jenis") == 2) {
      if($status["stok"] <= 0 ) {   
        $i = $this->db->insert("data_lensa", $data);
      } else {
        $i = $this->db->where("id", $status["id"])->update("data_lensa", $data);
      }
    } elseif($this->input->post("jenis") == 3) {
      if($status["stok"] <= 0 ) {   
        $i = $this->db->insert("data_cairan", $data);
      } else {
        $i = $this->db->where("id", $status["id"])->update("data_cairan", $data);
      }
    } else {
      if($status["stok"] <= 0 ) {   
        $i = $this->db->insert("data_softlense", $data);
      } else {
        $i = $this->db->where("id", $status["id"])->update("data_softlense", $data);
      }
    }

    if($i) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil simpan data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal simpan data'];
    }

    echo json_encode($json);exit;
  }

  function update_data_gudang()
  {
    if($this->input->post("jenis") == 1) {
      $data = [
        "id_frame" => $this->input->post("frame"),
        "status" => 1,
        "id_toko" => 0,
        "stok" => $this->input->post("stok"),
      ];
    } elseif($this->input->post("jenis") == 2) {

      if($this->input->post("type") == 1) {
        $minMax_val = $this->input->post("minus");
      } elseif($this->input->post("type") == 2) {
        $minMax_val = $this->input->post("plus");
      } else {
        $minMax_val = $this->input->post("minus")."|".$this->input->post("plus");
      }

      $data = [
        "id_lensa" => $this->input->post("lensa"),
        "status" => 1,
        "id_toko" => 0,
        "stok" => $this->input->post("stok"),
        "min_max" => $minMax_val,
        "type_lensa" => $this->input->post("type"),
        "sph" => $this->input->post("sph") != "" ? $this->input->post("sph") : "-",
        "cyl" => $this->input->post("cyl") != "" ? $this->input->post("cyl") : "-",
        "addl" => $this->input->post("add") != "" ? $this->input->post("add") : "-",
      ];
    } else {
      $data = [
        "id_cairan" => $this->input->post("cairan"),
        "status" => 1,
        "id_toko" => 0,
        "stok" => $this->input->post("stok"),
        "expired" => date('Y-m-d', strtotime($this->input->post("expired"))),
      ];

    }

    if($this->input->post("jenis") == 1) {
      $i = $this->db->where("id", $this->input->post("id_update"))->update("data_frame", $data);
    } elseif($this->input->post("jenis") == 2) {
      $i = $this->db->where("id", $this->input->post("id_update"))->update("data_lensa", $data);
    } else {
      $i = $this->db->where("id", $this->input->post("id_update"))->update("data_cairan", $data);
    }


    if($i) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil update data'];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal update data'];
    }

    echo json_encode($json);exit;
  }

  function cek_frame($id_frame, $status, $jenis) {
    if($jenis == "frame") {
      $cek = $this->db->get_where("data_frame", array("id_frame" => $id_frame, "status" => $status));
    } elseif($jenis == "cairan") {
      $cek = $this->db->get_where("data_cairan", array("id_cairan" => $id_frame, "status" => $status));
    } elseif($jenis == "softlense") {
      $cek = $this->db->get_where("data_softlense", array("id_softlense" => $id_frame, "status" => $status));
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

  function cek_lensa($id_lensa, $status, $type_lensa, $sph, $cyl, $add) {
    $cek = $this->db->get_where("data_lensa", array("id_lensa" => $id_lensa, "status" => $status, "type_lensa" => $type_lensa, "sph" => $sph,  "cyl" => $cyl, "addl" => $add));
    $stok = [];


    if($cek->num_rows() > 0) {
      $stok['stok'] = $cek->row()->stok;
      $stok['id'] = $cek->row()->id;
    } else {
      $stok['stok'] = 0;
    }

    return $stok;
  }

  function cek_softlense($id_lensa, $status, $sph, $cyl, $add) {
    $cek = $this->db->get_where("data_softlense", array("id_softlense" => $id_lensa, "status" => $status, "sph" => $sph,  "cyl" => $cyl, "addl" => $add));
    $stok = [];


    if($cek->num_rows() > 0) {
      $stok['stok'] = $cek->row()->stok;
      $stok['id'] = $cek->row()->id;
    } else {
      $stok['stok'] = 0;
    }

    return $stok;
  }

  function list_data_frame($id = "")
  {
    $data['id'] = $id;
    $data['type'] = "frame";
    $this->load->view("gudang/list_frame", $data);
  }

  function list_data_lensa($id = "")
  {
    $data['id'] = $id;
    $data['type'] = "lensa";
    $this->load->view("gudang/list_lensa", $data);
  }

  function list_data_cairan($id = "")
  {
    $data['id'] = $id;
    $data['type'] = "cairan";
    $this->load->view("gudang/list_cairan", $data);
  }

  function list_data_softlense($id = "")
  {
    $data['id'] = $id;
    $data['type'] = "softlense";
    $this->load->view("gudang/list_softlense", $data);
  }

  function ajax_list_frame($id = "-")
  {
    $list = $this->model_frame->get_datatables($id);
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {

      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->nama;
      $row[] = $field->stok;
      if($this->session->userdata("id_level") == 3) {
        $row[] = $field->harga_beli;
        $row[] = $field->harga_jual;
      } 
      if($id == "-") {
        $row[] = "<button class='btn btn-sm btn-warning tambah_data' id='".md5($field->id)."' type='frame'>EDIT</button>
        <button class='btn btn-sm btn-danger hapus' id='".md5($field->id)."' type='frame'>HAPUS</button>";
      } else {
        $row[] = "";
      }
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->model_frame->count_all($id),
      "recordsFiltered" => $this->model_frame->count_filtered($id),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function ajax_list_lensa($id = "-")
  {
    $list = $this->model_lensa->get_datatables($id);
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {

      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->nama;
      $row[] = $field->stok;
      /*if($field->type_lensa == 1) {
        $type_lensa = "[ - ] ".$field->min_max;;
      } elseif($field->type_lensa == 2) {
        $type_lensa = "[ + ] ".$field->min_max;;
      } elseif($field->type_lensa == 3) {
        $type_lensa = "[ - ][ + ] ".$field->min_max;
      } elseif($field->type_lensa == 4) {
        $type_lensa = "[ - ] Add ".$field->min_max;
      } else {
        $type_lensa = "[ + ] ".$field->min_max;
      }*/
      // $row[] = $type_lensa;
      $row[] = $field->sph;
      $row[] = $field->cyl;
      $row[] = $field->addl;
      if($this->session->userdata("id_level") == 3) {
        $row[] = $field->harga_beli;
        $row[] = $field->harga_jual;
      } 
      if($id == "-") {
        $row[] = "<button class='btn btn-sm btn-warning tambah_data' id='".md5($field->id)."' type='lensa'>EDIT</button>
        <button class='btn btn-sm btn-danger hapus' id='".md5($field->id)."' type='lensa'>HAPUS</button>";
      } else {
        $row[] = "";
      }
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->model_lensa->count_all($id),
      "recordsFiltered" => $this->model_lensa->count_filtered($id),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function ajax_list_cairan($id = "-")
  {
    $list = $this->model_cairan->get_datatables($id);
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {

      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->nama;
      $row[] = date('d-m-Y', strtotime($field->expired));
      $row[] = $field->stok;
      if($this->session->userdata("id_level") == 3) {
        $row[] = $field->harga_beli;
        $row[] = $field->harga_jual;
      } 
      if($id == "-") {
        $row[] = "<button class='btn btn-sm btn-warning tambah_data' id='".md5($field->id)."' type='cairan'>EDIT</button>
        <button class='btn btn-sm btn-danger hapus' id='".md5($field->id)."' type='cairan'>HAPUS</button>";
      } else {
        $row[] = "";
      }
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->model_cairan->count_all($id),
      "recordsFiltered" => $this->model_cairan->count_filtered($id),
      "data" => $data,
    );

    echo json_encode($output);
  }


  function ajax_list_softlense($id = "-")
  {
    $list = $this->model_softlense->get_datatables($id);
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {

      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->nama;
      $row[] = date('d-m-Y', strtotime($field->expired));
      $row[] = $field->stok;
      if($this->session->userdata("id_level") == 3) {
        $row[] = $field->harga_beli;
        $row[] = $field->harga_jual;
      } 
      if($id == "-") {
        $row[] = "<button class='btn btn-sm btn-warning tambah_data' id='".md5($field->id)."' type='cairan'>EDIT</button>
        <button class='btn btn-sm btn-danger hapus' id='".md5($field->id)."' type='cairan'>HAPUS</button>";
      } else {
        $row[] = "";
      }
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->model_softlense->count_all($id),
      "recordsFiltered" => $this->model_softlense->count_filtered($id),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function hapus_list_data($type, $id)
  {
    if($type == "frame") {
      $d = $this->db->where("md5(id)", $id)->delete("data_frame");
    } elseif($type == "lensa") {
      $d = $this->db->where("md5(id)", $id)->delete("data_lensa");
    } else {
      $d = $this->db->where("md5(id)", $id)->delete("data_cairan");
    }

    if($d) {
      $json = ['s' => 'sukses', 'm' => 'Berhasil hapus data '.$type];
    } else {
      $json = ['s' => 'gagal', 'm' => 'Gagal hapus data '.$type];
    }

    echo json_encode($json);exit;
  }

  function restok_toko($id_toko = '')
  {
    
    if($this->session->userdata("id_level") != 3) {
      $this->db->where("id", $this->session->userdata("id_toko"));
    }
    $data['toko'] = $this->db->get("master_toko")->result();

    $this->template->load("gudang/restok_toko", $data);
  }

  function cek_kriptok($id) 
  {
    $cek = $this->db->get_where("master_lensa", array("id" => $id))->row();

    $json['isKriptok'] = $cek->tipe_lensa == 2 ? true : false;

    echo json_encode($json);exit;
  }
}