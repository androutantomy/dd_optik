<?php

class M_Level_user extends CI_Model {

    function save() {
        $data = array(
            'nama_level' => $this->input->post('nama_level'),
        );
        $this->db->insert('master_user_level', $data);
    }

    function edit() {

        $data = array(
            'nama_level' => $this->input->post('nama_level'),
        );
        $id= $this->input->post('id');
        $this->db->where('id',$id);
        $this->db->update('master_user_level',$data);
    }

}

?>