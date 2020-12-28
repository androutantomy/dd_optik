<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_penjualan extends CI_Model {
    var $table = 'penjualan';
    var $column_order = array(null, 'nama', 'tanggal_nota', 'tgl_selesai');
    var $column_search = array('nama','tanggal_nota','tgl_selesai');
    var $order = array('tanggal_nota' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($level='-')
    {   

        if($this->session->userdata("id_level") != 3) {
            $this->db->where("penjualan.id_toko", $this->session->userdata("id_toko"));
        }
        $this->db->select("penjualan.*")->from("penjualan");

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

    private function _get_datatables_query2($level='-')
    {   
        $column_ordere = array(null, "nama", "tgl_transaksi");
        $ordere = array("tgl_transaksi" => "desc");
        $column_searce = array("nama", "tgl_transaksi");

        if($this->session->userdata("id_level") != 3) {
            $this->db->where("penjualan_barang.id_toko", $this->session->userdata("id_toko"));
        }
        $this->db->select("penjualan_barang.*")->from("penjualan_barang");

        $i = 0; 
        foreach ($column_searce as $item) 
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
            $this->db->order_by($column_ordere[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($ordere))
        {
            $order = $ordere;
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

    function get_datatables2($level='-')
    {       
        $this->_get_datatables_query2($level);   
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered2($level='-')
    {
        $this->_get_datatables_query2($level);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all2($level='-')
    {
        $this->db->from("penjualan_barang");
        return $this->db->count_all_results();
    }
}