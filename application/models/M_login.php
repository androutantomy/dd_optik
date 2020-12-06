<?php 
 
class M_login extends CI_Model{	

	
	function cek_role($table,$where){		
		return $this->db->get_where($table,$where);
	}	

	function cek_login($username,$password){ 
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$result = $this->db->get('user');
		return $result;
	}
}