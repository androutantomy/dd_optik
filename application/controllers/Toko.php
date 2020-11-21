<?php

class Toko extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Toko');
        // chek_akses_modul();
        // chek_seesion();
    }

    function index() {
        $data['toko'] = $this->db->get('master_toko')->result();
        $this->template->load('toko/list', $data);
    }

    function add() {
        // $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_toko','nama_toko','required');
        $this->form_validation->set_rules('alamat','alamat','required');
        $this->form_validation->set_rules('telp','telp','required');
        $this->form_validation->set_rules('logo','logo','required');
        if(isset($_POST['submit'])){
            if($this->form_validation->run()!=FALSE) {
                $this->M_Toko->save();
                $this->session->set_flashdata('message','Berhasil Menambahkan Toko');
            }else{
                $this->session->set_flashdata('pesan','Mohon Isi Data Dengan Benar');
            }
              redirect('Toko'); 
        } else {
            $data['toko'] = $this->db->get('master_toko')->result();
            $this->template->load('toko/list', $data);
        }
    }

    function edit() {
        if (isset($_POST['submit'])) {
            $this->M_Toko->edit();
            redirect('Toko');
        } else {
            $id= $this->uri->segment(3);
            $data['edit']=$this->db->get_where('master_toko',array('id'=>$id))->row_Array();
            $this->template->load('toko/edit',$data);
        }
    }
    
    function hapus(){
        $id= $this->uri->segment(3);
        $this->db->where('id',$id);
        $this->db->delete('master_toko');
        redirect('Toko');
    }

    function restok_toko()
    {
        $data['toko'] = $this->db->get("master_toko")->result();
        $this->load->view("toko/restok", $data);
    }

    function list_barang($type)
    {
        $option_arr = ["Pilih"];
        if($type == 1) {
            $g = $this->db->select("master_frame.nama, master_frame.id as id_master_frame, data_frame.*")->join("master_frame", "master_frame.id = data_frame.id_frame")->get_where("data_frame", array("status" => 1))->result();
            foreach($g as $val) {
                $option_arr[$val->id_master_frame] = '[ '.$val->stok.' ]  '.$val->nama;
            }

            $option = form_dropdown("frame", $option_arr, '', array("class" => "form-control form-control-sm", "id" => "frame", "required" => "required"));

        } elseif($type == 2) {
            $g = $this->db->select("master_lensa.nama_lensa, master_lensa.id as id_master_lensa, data_lensa.*")->join("master_lensa", "master_lensa.id = data_lensa.id_lensa")->get_where("data_lensa", array("status" => 1))->result();
            foreach($g as $val) {
                $exp = explode(",", $val->min_max);
                if($val->type_lensa == 1) {
                    $min = "MIN";
                    $max = "MAX";
                } elseif($val->type_lensa == 2) {
                    $min = "MIN";
                    $max = "ADD";
                } else {
                    $min = "MAX";
                    $max = "ADD";
                }
                $option_arr[$val->id] = '[ '.$val->stok.' ] '.$min.' '. $exp[0] .' '. $max .' '.$exp[1].' | '.$val->nama_lensa;
            }

            $option = form_dropdown("lensa", $option_arr, '', array("class" => "form-control form-control-sm", "id" => "lensa", "required" => "required"));

        } else {
            $g = $this->db->select("master_cairan.nama, master_cairan.id as id_master_cairan, data_cairan.*")->join("master_cairan", "master_cairan.id = data_cairan.id_cairan")->get_where("data_cairan", array("status" => 1))->result();
            foreach($g as $val) {
                $option_arr[$val->id_master_cairan] = '[ '.$val->stok.' ]  '.$val->nama;
            }

            $option = form_dropdown("cairan", $option_arr, '', array("class" => "form-control form-control-sm", "id" => "cairan", "required" => "required"));
        }

        $json = ['s' => 'sukses', 'option' => $option];

        echo json_encode($json);exit;
    }

    function simpan_data_restok_toko()
    {
        if($this->input->post("jenis") == 1) {
            $status = $this->cek_frame($this->input->post("frame"), 1, "frame", $this->input->post("stok"));
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
            $status = $this->cek_frame($this->input->post("cairan"), 1, "cairan", $this->input->post("stok"));
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

    function cek_frame($id_frame, $status, $jenis, $stok) {
        if($jenis == "frame") {
            $cek = $this->db->get_where("data_frame", array("id_frame" => $id_frame, "status" => $status));
        } elseif($jenis == "cairan") {
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
}

?>