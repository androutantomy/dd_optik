<?php

class Level_user extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Level_user');
        // chek_akses_modul();
        // chek_seesion();
    }

    function index() {
        $data['level_user'] = $this->db->get('master_user_level')->result();
        $this->template->load('level_user/list', $data);
    }

    function add() {
        // $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_level','nama_level','required');
        if(isset($_POST['submit'])){
            if($this->form_validation->run()!=FALSE) {
                $this->M_Level_user->save();
                $this->session->set_flashdata('message','Berhasil Menambahkan Level User');
            }else{
                $this->session->set_flashdata('pesan','Mohon Isi Data Dengan Benar');
            }
              redirect('Level_user'); 
        } else {
            $data['level_user'] = $this->db->get('master_user_level')->result();
            $this->template->load('level_user/list', $data);
        }
    }

    function edit() {
        if (isset($_POST['submit'])) {
            $this->M_Level_user->edit();
            redirect('Level_user');
        } else {
            $id= $this->uri->segment(3);
            $data['edit']=$this->db->get_where('master_user_level',array('id'=>$id))->row_Array();
            $this->template->load('level_user/edit',$data);
        }
    }
    
    function hapus(){
        $id= $this->uri->segment(3);
        $this->db->where('id',$id);
        $this->db->delete('master_user_level');
        redirect('Level_user');
    }

}

?>