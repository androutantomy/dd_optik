<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan extends CI_Model {
    var $table = 'penjualan';
    var $column_order = array(null, '', 'penjualan.nama', 'penjualan.nama_frame', 'penjualan.nama_lensa', 'penjualan.tanggal_nota', '');
    var $column_search = array('master_toko.nama_toko', 'penjualan.nama', 'penjualan.nama_frame', 'penjualan.nama_lensa');
    var $order = array('penjualan.tanggal_nota' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($id_toko, $start, $end)
    {   

        $this->db->select("penjualan.*,")->from($this->table);
        if($id_toko != "-") {
            $this->db->where("id_toko", $id_toko);
        }

        if($this->session->userdata("id_level") != 3) {
            $this->db->where("penjualan.id_toko", $this->session->userdata("id_toko"));
        }
        if($start != '-' && $end == '-') {
            $this->db->where("penjualan.tanggal_nota >=", $start." 00:00:00");
            $this->db->where("penjualan.tanggal_nota <=", $start." 23:59:00");
        } elseif($end != '-' && $start == '-') {
            $this->db->where("penjualan.tanggal_nota >=", $end." 00:00:00");
            $this->db->where("penjualan.tanggal_nota <=", $end." 23:59:00");
        } elseif($end != '-' && $start != '-') {
            $this->db->where("penjualan.tanggal_nota >=", $start." 00:00:00");
            $this->db->where("penjualan.tanggal_nota <=", $end." 23:59:00");
        }

        $this->db->where("status", 1);

        $i = 0; 
            foreach ($this->column_search as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {

                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($this->column_search) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                    }
                    $i++;
                }       
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }  
        }

        function get_datatables($id_toko, $start, $end)
        {       
            $this->_get_datatables_query($id_toko, $start, $end);   
            if($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered($id_toko, $start, $end)
        {
            $this->_get_datatables_query($id_toko, $start, $end);
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all()
        {
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }

        // get data cairan

        private function _get_datatables_query2($id_toko, $start, $end)
        {   
            $column_order2 = array(null, '', 'penjualan_barang.nama', 'penjualan_barang.nama_barang', 'penjualan_barang.tgl_transaksi');
            $column_search2 = array('', 'penjualan_barang.nama', 'penjualan_barang.nama_barang', 'penjualan_barang.tgl_transaksi');
            $order2 = array('penjualan_barang.tgl_transaksi' => 'asc');

            $this->db->select("penjualan_barang.*,")->from("penjualan_barang");
            if($id_toko != "-") {
                $this->db->where("id_toko", $id_toko);
            }
            if($this->session->userdata("id_level") != 3) {
                $this->db->where("penjualan_barang.id_toko", $this->session->userdata("id_toko"));
            }

            if($start != '-' && $end == '-') {
                $this->db->where("penjualan_barang.tgl_transaksi >=", $start." 00:00:00");
                $this->db->where("penjualan_barang.tgl_transaksi <=", $start." 23:59:00");
            } elseif($end != '-' && $start == '-') {
                $this->db->where("penjualan_barang.tgl_transaksi >=", $end." 00:00:00");
                $this->db->where("penjualan_barang.tgl_transaksi <=", $end." 23:59:00");
            } elseif($end != '-' && $start != '-') {
                $this->db->where("penjualan_barang.tgl_transaksi >=", $start." 00:00:00");
                $this->db->where("penjualan_barang.tgl_transaksi <=", $end." 23:59:00");
            }

            $i = 0; 
            foreach ($column_search2 as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {

                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                    if(count($column_search2) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                    }
                    $i++;
                }       
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order))
            {
                $order = $order2;
                $this->db->order_by(key($order), $order[key($order)]);
            }  
        }

        function get_datatables2($id_toko, $start, $end)
        {       
            $this->_get_datatables_query2($id_toko, $start, $end);   
            if($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered2($id_toko, $start, $end)
        {
            $this->_get_datatables_query($id_toko, $start, $end);
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all2()
        {
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }

        // end get data cairan

        function get_dataexcel($id_toko, $start, $end)
        {
            $this->db->select("penjualan.*,")->from("penjualan");
            if($id_toko != "-") {
                $this->db->where("id_toko", $id_toko);
            }

            if($start != '-' && $end == '-') {
                $this->db->where("penjualan.tanggal_nota >=", $start." 00:00:00");
                $this->db->where("penjualan.tanggal_nota <=", $start." 23:59:00");
            } elseif($end != '-' && $start == '-') {
                $this->db->where("penjualan.tanggal_nota >=", $end." 00:00:00");
                $this->db->where("penjualan.tanggal_nota <=", $end." 23:59:00");
            } elseif($end != '-' && $start != '-') {
                $this->db->where("penjualan.tanggal_nota >=", $start." 00:00:00");
                $this->db->where("penjualan.tanggal_nota <=", $end." 23:59:00");
            }

            return $this->db->get()->result();
        }

        function get_dataexcel_cairan($id_toko, $start, $end)
        {
            $this->db->select("penjualan_barang.*,")->from("penjualan_barang");
            if($id_toko != "-") {
                $this->db->where("id_toko", $id_toko);
            }

            if($start != '-' && $end == '-') {
                $this->db->where("penjualan_barang.tgl_transaksi >=", $start." 00:00:00");
                $this->db->where("penjualan_barang.tgl_transaksi <=", $start." 23:59:00");
            } elseif($end != '-' && $start == '-') {
                $this->db->where("penjualan_barang.tgl_transaksi >=", $end." 00:00:00");
                $this->db->where("penjualan_barang.tgl_transaksi <=", $end." 23:59:00");
            } elseif($end != '-' && $start != '-') {
                $this->db->where("penjualan_barang.tgl_transaksi >=", $start." 00:00:00");
                $this->db->where("penjualan_barang.tgl_transaksi <=", $end." 23:59:00");
            }

            return $this->db->get()->result();
        }
    }