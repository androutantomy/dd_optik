<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_lensa extends CI_Model {
    var $table = 'data_lensa';
        var $column_order = array(null, 'master_lensa.nama_lensa', 'data_lensa.stok', '', '', );
        var $column_search = array('master_lensa.nama_lensa');
        var $order = array('master_lensa.nama_lensa' => 'asc'); // default order 

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        private function _get_datatables_query($level='-')
        {   
      
            $this->db->select("data_lensa.*, master_lensa.nama_lensa")->from($this->table)
            ->join("master_lensa", "master_lensa.id = data_lensa.id_lensa")
            ;
            
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