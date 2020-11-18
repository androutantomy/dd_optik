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
                $this->M_toko->save();
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
            $this->M_toko->edit();
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

}

?>