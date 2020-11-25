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
        
         $data = array(
            'nama_toko' => $this->input->post("nama_toko"),
            'alamat' => $this->input->post("alamat"),
            'telp' => $this->input->post("telp")
    );
    
    if ($this->input->post("logo") != ""){
        $path = FCPATH.'/uploads/logo/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    
        $lolos = 0;
        if (!$this->upload->do_upload('logo')){
            $lolos = 1;
            echo $this->upload->display_errors();
            // $data['logo'] = $path.$this->upload->data('file_name');
        }else{
            $lolos = 1;
        }
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

}

?>