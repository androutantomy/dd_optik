<?php

class Master_user extends CI_Controller {

    function __construct() {
        parent::__construct();
        // $this->load->model('Master_user');
        // chek_akses_modul();
        // chek_seesion();
    }

    function index() {
        $data['user'] = $this->db->get('user')->result();
        $this->template->load('master/list_user', $data);
    }

    function add() {

        $data = array(
            'id_level' => $this->input->post("id_level"),
            'id_toko' => $this->input->post("id_toko"),
            'nama_lengkap' => $this->input->post("nama_lengkap"),
            'username' => $this->input->post("username"),
            'password' => $this->input->post("password")
        );

        if(!empty($_FILES["logo"]["name"])){
            $mkdir = "uploads/foto_profil/";

            if(!is_dir($mkdir)){ 
                mkdir($mkdir,0777,TRUE); 
                // echo "tidak ada ";exit;
            }
            $tgl = date("d");
            $jam = date("His");

            $nama_file = $this->input->post("nama_lengkap").'_'.$jam;

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

        $i = $this->db->insert("user", $data);

        if($i) {
            $json = ['s' => 'sukses', 'm' => 'Berhasil simpan data'];
        } else {
            $json = ['s' => 'gagal', 'm' => 'Gagal simpan data'];
        }

        echo json_encode($json);exit;
    }

    function edit() {
        $data = array(
            'id_level' => $this->input->post("id_level_edit"),
            'id_toko' => $this->input->post("id_toko_edit"),
            'nama_lengkap' => $this->input->post("nama_lengkap_edit"),
            'username' => $this->input->post("username_edit"),
            'password' => $this->input->post("password_edit")
        );

        if(!empty($_FILES["logo_edit"]["name"])){
            $mkdir = "uploads/foto_profil/";

            if(!is_dir($mkdir)){ 
                mkdir($mkdir,0777,TRUE); 
                // echo "tidak ada ";exit;
            }
            $tgl = date("d");
            $jam = date("His");

            $nama_file = $this->input->post("nama_lengkap").'_'.$jam;

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

                    $data['logo_edit'] = $link;
                }else{
                    $errors = $this->upload->display_errors();
                    $json['alert']  = $errors;
                    echo json_encode($json);
                    exit;
                }
            }
        }

        $i = $this->db->where("id", $this->input->post("id_edit"))->update("user", $data);

        if($i) {
            $json = ['s' => 'sukses', 'm' => 'Berhasil update data'];
        } else {
            $json = ['s' => 'gagal', 'm' => 'Gagal update data'];
        }

        echo json_encode($json);exit;
    }

    function hapus_user($id){
        $i = $this->db->where("md5(id)", $id)->delete("user");

        if($i) {
            $json = ['s' => 'sukses', 'm' => 'Berhasil hapus data'];
        } else {
            $json = ['s' => 'gagal', 'm' => 'Gagal hapus data'];
        }

        echo json_encode($json);exit;
    }

    function get_data_user($id)
    {
        $g = $this->db->get_where("user", array("md5(id)" => $id));

        if($g->num_rows() > 0) {
            $json = ["s" => "sukses", "m" => $g->row()];
        } else {
            $json = ["s" => "gagal", "m" => 'Data tidak ditemukan'];
        }

        echo json_encode($json);exit;
    }
}

?>