<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_softlense extends CI_Model {
    var $table = 'data_softlense';
        var $column_order = array(null, 'master_softlense.nama', 'data_softlense.stok', '', '', );
        var $column_search = array('master_softlense.nama');
        var $order = array('master_softlense.nama' => 'asc'); // default order 

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        private function _get_datatables_query($id='-')
        {   
      
            $this->db->select("data_softlense.*, master_softlense.nama, master_softlense.harga_jual, master_softlense.harga_beli")->from($this->table)
            ->join("master_softlense", "master_softlense.id = data_softlense.id_softlense");
            if($id != "-") {
                $this->db->where("status", 2);
                $this->db->where("md5(id_toko)", $id);
            }
            
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

        function get_datatables($id='-')
        {       
            $this->_get_datatables_query($id);   
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered($id='-')
        {
            $this->_get_datatables_query($id);
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all($id='-')
        {
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }
}