<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	function get_all(){
		return $this->db->get('user');
	}	

	function get_data($where,$table){
		return $this->db->get_where($table,$where);
	}

	function get_data_profil($where,$table,$param){
		return $this->db->select('*')
						->from('user')
						->join($table,$param)
						->where($where)
						->get();
	}

	function insert($data,$table){
		$this->db->insert($table,$data);
	}

	function update($where,$data,$table){
		$this->db->where($where)
				 ->update($table,$data);
	}

	function delete($where,$table){
		$this->db->where($where)
				 ->delete($table);
	}

}

/* End of file jurusan_model.php */
/* Location: ./application/models/jurusan_model.php */