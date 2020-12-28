<?php

class Toko extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Toko');
        
        if($this->session->userdata('status') == ''){
            redirect(base_url('auth'));
        }
    }

    function index() {
        $data['toko'] = $this->db->get('master_toko')->result();
        $this->template->load('toko/list', $data);
    }

    function add() {

        $data = array(
            'nama_toko' => $this->input->post("nama_toko"),
            'alamat' => $this->input->post("alamat"),
            'telp' => $this->input->post("telp")
        );

        if(!empty($_FILES["logo_edit"]["name"])){
            $mkdir = "uploads/logo/";

            if(!is_dir($mkdir)){ 
                mkdir($mkdir,0777,TRUE); 
                // echo "tidak ada ";exit;
            }
            $tgl = date("d");
            $jam = date("His");

            $nama_file = $this->input->post("nama_toko").'_'.$jam;

            $config['upload_path']          = $mkdir;
            $config['allowed_types']        = 'pdf|jpg|png|jpeg|zip|rar';
            $config['file_name']            = $nama_file;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if(!empty($_FILES['logo']['name'])){

                $_FILES['file']['name'] = $_FILES['logo']['name'];
                $_FILES['file']['type'] = $_FILES['logo']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['logo']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['logo']['error'];
                $_FILES['file']['size'] = $_FILES['logo']['size'];

                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();

                    $name = $uploadData['file_name'];
                    $link = base_url().$mkdir.$name;

                    $data['logo'] = $link;
                }else{
                    $errors = $this->upload->display_errors();
                    $json['alert']  = $errors;
                    echo json_encode($json);
                    exit;
                }
            }
        }

        $i = $this->db->insert("master_toko", $data);

        if($i) {
            $json = ['s' => 'sukses', 'm' => 'Berhasil simpan data'];
        } else {
            $json = ['s' => 'gagal', 'm' => 'Gagal simpan data'];
        }

        echo json_encode($json);exit;
    }

    function edit() {
        $data = array(
            'nama_toko' => $this->input->post("nama_toko_edit"),
            'alamat' => $this->input->post("alamat_edit"),
            'telp' => $this->input->post("telp_edit")
        );

        if(!empty($_FILES["logo_edit"]["name"])){
            $mkdir = "uploads/logo/";

            if(!is_dir($mkdir)){ 
                mkdir($mkdir,0777,TRUE); 
                // echo "tidak ada ";exit;
            }
            $tgl = date("d");
            $jam = date("His");

            $nama_file = $this->input->post("nama_toko").'_'.$jam;

            $config['upload_path']          = $mkdir;
            $config['allowed_types']        = 'pdf|jpg|png|jpeg|zip|rar';
            $config['file_name']            = $nama_file;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if(!empty($_FILES['logo_edit']['name'])){

                $_FILES['file']['name'] = $_FILES['logo_edit']['name'];
                $_FILES['file']['type'] = $_FILES['logo_edit']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['logo_edit']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['logo_edit']['error'];
                $_FILES['file']['size'] = $_FILES['logo_edit']['size'];

                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();

                    $name = $uploadData['file_name'];
                    $link = base_url().$mkdir.$name;

                    $data['logo'] = $link;
                }else{
                    $errors = $this->upload->display_errors();
                    $json['alert']  = $errors;
                    echo json_encode($json);
                    exit;
                }
            }
        }

        $i = $this->db->where("id", $this->input->post("id_edit"))->update("master_toko", $data);

        if($i) {
            $json = ['s' => 'sukses', 'm' => 'Berhasil update data'];
        } else {
            $json = ['s' => 'gagal', 'm' => 'Gagal update data'];
        }

        echo json_encode($json);exit;
    }

    function hapus_toko($id){
        $i = $this->db->where("md5(id)", $id)->delete("master_toko");

        if($i) {
            $json = ['s' => 'sukses', 'm' => 'Berhasil hapus data'];
        } else {
            $json = ['s' => 'gagal', 'm' => 'Gagal hapus data'];
        }

        echo json_encode($json);exit;
    }

    function restok_toko()
    {
        $data['daftar_toko'] = $this->db->get("master_toko")->result();
        $data['toko'] = $this->db->get("master_toko")->result();
        $this->load->view("toko/restok", $data);
    }

    function list_barang($type, $toko = "-")
    {
        $option_arr = ["Pilih"];
        if($type == 1) {
            if($this->session->userdata("id_level") != 3) {
                $this->db->where("data_frame.status", "2");
                $this->db->where("data_frame.id_toko", $this->session->userdata("id_toko"));
            } else {
                if($toko != '-') {
                    $this->db->where("data_frame.id_toko", $toko);
                    $this->db->where("data_frame.status", "2");
                } else {
                    $this->db->where("data_frame.status", "1");
                }
            }
            $g = $this->db->select("master_frame.nama, master_frame.id as id_master_frame, data_frame.*")->join("master_frame", "master_frame.id = data_frame.id_frame")->get("data_frame")->result();
            foreach($g as $val) {
                $option_arr[$val->id_frame] = '[ '.$val->stok.' ]  '.$val->nama;
            }

            $option = form_dropdown("frame", $option_arr, '', array("class" => "form-control form-control-sm", "id" => "frame", "required" => "required"));

        } elseif($type == 2) {

            $g = $this->db->select("master_lensa.nama, master_lensa.id as id_master_lensa, data_lensa.*")->join("master_lensa", "master_lensa.id = data_lensa.id_lensa")->get_where("data_lensa", array("status" => 1))->result();
            foreach($g as $val) {

                $option_arr[$val->id] = '[ '.$val->stok.' ] '.$val->nama;
            }
            $option = form_dropdown("lensa", $option_arr, '', array("class" => "form-control form-control-sm", "id" => "lensa", "required" => "required"));

        } else {
            if($this->session->userdata("id_level") != 3) {
                $this->db->where("data_cairan.status", "2");
                $this->db->where("data_cairan.id_toko", $this->session->userdata("id_toko"));
            } else {
                if($toko != '-') {
                    $this->db->where("data_cairan.id_toko", $toko);
                    $this->db->where("data_cairan.status", "2");
                } else {
                    $this->db->where("data_cairan.status", "1");
                }
            }
            $g = $this->db->select("master_cairan.nama, master_cairan.id as id_master_cairan, data_cairan.*")->join("master_cairan", "master_cairan.id = data_cairan.id_cairan")->get("data_cairan")->result();
            foreach($g as $val) {
                $option_arr[$val->id_cairan] = '[ '.$val->stok.' ]  '.$val->nama;
            }

            $option = form_dropdown("cairan", $option_arr, '', array("class" => "form-control form-control-sm", "id" => "cairan", "required" => "required"));
        }

        $json = ['s' => 'sukses', 'option' => $option];

        echo json_encode($json);exit;
    }

    function simpan_data_restok_toko()
    {
        $tipe = $this->input->post("tipe");
        $status = ($tipe == 1) ? 1 : 2;
        if($this->session->userdata("id_level") != 3) {
            $status = 2;
        }

        if($this->input->post("jenis") == 1) {
            $status = $this->cek_frame($this->input->post("frame"), $status, "frame", $this->input->post("stok"), $tipe);
            if($status['s'] == "error") {
                echo json_encode($status);exit;
            }
            $data = [
                "id_frame" => $this->input->post("frame"),
                "status" => 2,
                "id_toko" => $this->input->post("toko"),
                "stok" => $this->input->post("stok"),
            ];
        } elseif($this->input->post("jenis") == 2) {

            $g = $this->db->get_where("data_lensa", array("id" => $this->input->post("lensa")))->row();
            if($g->stok < $this->input->post("stok")) {
                echo json_encode($json = ["s" => "error", "m" => "Nominal stok untuk toko lebih banyak dari stok gudang"]);exit;
            }
            $status["stok"] = $g->stok;
            $status["id"] = $g->id;
            $status["id_lensa"] = $g->id_lensa;
            $data = [
                "id_lensa" => $g->id_lensa,
                "status" => 2,
                "id_toko" => $this->input->post("toko"),
                "stok" => $this->input->post("stok"),
                "min_max" => $g->min_max,
                "type_lensa" => $g->type_lensa,
            ];
        } else {
            $status = $this->cek_frame($this->input->post("cairan"), $status, "cairan", $this->input->post("stok"), $tipe);
            if($status['s'] == "error") {
                echo json_encode($status);exit;
            }

            $data = [
                "id_cairan" => $this->input->post("cairan"),
                "status" => 2,
                "id_toko" => $this->input->post("toko"),
                "stok" => $this->input->post("stok"),
            ];
        }

        if($this->input->post("jenis") == 1) {
            $u = $this->db->set("stok", $status["stok"] - $this->input->post("stok"))->where("id", $status["id"])->update("data_frame");
            $c = $this->db->get_where("data_frame", array("id_frame" => $this->input->post("frame"), "status" => 2, "id_toko" => $this->input->post("toko")));
            if($c->num_rows() <= 0) {        
                $i = $this->db->insert("data_frame", $data);
            } else {
                $data['stok'] = $c->row()->stok + $this->input->post("stok");
                $i = $this->db->where("id", $c->row()->id)->update("data_frame", $data);
            }
        } elseif($this->input->post("jenis") == 2) {
            $u = $this->db->set("stok", $status["stok"] - $this->input->post("stok"))->where("id", $status["id"])->update("data_lensa");
            $c = $this->db->get_where("data_lensa", array("id_lensa" => $status["id_lensa"], "status" => 2, "id_toko" => $this->input->post("toko")));
            if($c->num_rows() <= 0) {      
                $i = $this->db->insert("data_lensa", $data);
            } else {
                $i = $this->db->where("id", $c->row()->id)->update("data_lensa", $data);
            }
        } else {
            $u = $this->db->set("stok", $status["stok"] - $this->input->post("stok"))->where("id", $status["id"])->update("data_cairan");
            $c = $this->db->get_where("data_cairan", array("id_cairan" => $this->input->post("cairan"), "status" => 2, "id_toko" => $this->input->post("toko")));
            if($c->num_rows() <= 0) {        
                $i = $this->db->insert("data_cairan", $data);
            } else {
                $data['stok'] = $c->row()->stok + $this->input->post("stok");
                $i = $this->db->where("id", $c->row()->id)->update("data_cairan", $data);
            }
        }

        if($i) {
            $json = ['s' => 'sukses', 'm' => 'Berhasil simpan data'];
        } else {
            $json = ['s' => 'gagal', 'm' => 'Gagal simpan data'];
        }

        echo json_encode($json);exit;
    }

    function cek_frame($id_frame, $status, $jenis, $stok, $tipe) {
        if($jenis == "frame") {
            if($tipe == 2) {
                $this->db->where("id_toko", $this->session->userdata("id_toko"));
            }
            $cek = $this->db->get_where("data_frame", array("id_frame" => $id_frame, "status" => $status));
        } elseif($jenis == "cairan") {
            if($tipe == 2) {
                $this->db->where("id_toko", $this->session->userdata("id_toko"));
            }
            $cek = $this->db->get_where("data_cairan", array("id_cairan" => $id_frame, "status" => $status));
        }
        $respon = [];
        
        if($cek->num_rows() > 0) {
            if($cek->row()->stok < $stok) {
                $respon = ["s" => "error", "m" => "Nominal stok untuk toko lebih banyak dari stok gudang"];
            } else {
                $respon = ["s" => "sukses", "stok" => $cek->row()->stok, "id" => $cek->row()->id];
            }
        } else {
            $respon = ["s" => "error", "m" => "Data tidak ditemukan"];
        }

        return $respon;
    }

    function cek_lensa($id_lensa, $status, $min_max, $type_lensa) {
        $cek = $this->db->get_where("data_lensa", array("id_lensa" => $id_lensa, "status" => $status, "min_max" => $min_max, "type_lensa" => $type_lensa));
        $stok = [];

        if($cek->num_rows() > 0) {
            $stok['stok'] = $cek->row()->stok;
            $stok['id'] = $cek->row()->id;
        } else {
            $stok['stok'] = 0;
        }

        return $stok;
    }

    function get_data_toko($id)
    {
        $g = $this->db->get_where("master_toko", array("md5(id)" => $id));

        if($g->num_rows() > 0) {
            $json = ["s" => "sukses", "m" => $g->row()];
        } else {
            $json = ["s" => "gagal", "m" => 'Data tidak ditemukan'];
        }

        echo json_encode($json);exit;
    }
}

?>