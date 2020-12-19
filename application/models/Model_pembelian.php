<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pembelian extends CI_Model {
    var $table = 'pembelian';
    var $column_order = array(null, 'nama', 'tanggal_nota');
    var $column_search = array('nama','tanggal_nota');
    var $order = array('tanggal_nota' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($level='-')
    {   

        $this->db->select("*")->from("pembelian");

        $i = 0; 
        foreach ($this->column_search as $item) 
        {
            if($_POST['search']['value'])
            {

                if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }       
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }  
    }

    function get_datatables($level='-')
    {       
        $this->_get_datatables_query($level);   
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($level='-')
    {
        $this->_get_datatables_query($level);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($level='-')
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}