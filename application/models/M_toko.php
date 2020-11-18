<?php

class M_toko extends CI_Model {

    function save() {
        $data = array(
            'nama_toko' => $this->input->post('nama_toko'),
            'alamat' => $this->input->post('alamat'),
            'telp' => $this->input->post('telp'),
            'logo' => $this->input->post('logo'),
        );
        $this->db->insert('master_toko', $data);
    }

    function edit() {

        $data = array(
            'nama_toko' => $this->input->post('nama_toko'),
            'alamat' => $this->input->post('alamat'),
            'telp' => $this->input->post('telp'),
            'logo' => $this->input->post('logo'),
        );
        $id= $this->input->post('id');
        $this->db->where('id',$id);
        $this->db->update('master_toko',$data);
    }

}

?>