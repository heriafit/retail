<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

	function get_all(){
		return $this->db->get('barang');
	}

	function get_info_barang($where){
		return $this->db->select("*")
						->from('barang')
						->join('barang_dipinjam','barang_dipinjam.kode_barang = barang.kode_barang')
						->join('peminjaman','peminjaman.kode_peminjaman = barang_dipinjam.kode_peminjaman')
						->where($where)
						->order_by('tgl_peminjaman','ASC')
						->get();
	}

	function get_kode($date){
		return $this->db->select('kode_penerimaan')
						->from('barang_masuk')
						->order_by('tgl_penerimaan', 'DESC')
						->where('date(tgl_penerimaan)',$date)
						->limit(1,0)
						->get();
	}

	function get_log($where){
		return $this->db->select('*')
						->from('logging_barang')
						->where($where)
						->get();
	}	

	function get_data($where,$table){
		return $this->db->get_where($table,$where);
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

/* End of file berita_model.php */
/* Location: ./application/models/berita_model.php */