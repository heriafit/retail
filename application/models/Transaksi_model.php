<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	function get_all(){
		return $this->db->select('*')
						->from('peminjaman')
						->get();
	}	

	function get_kode($date){
		return $this->db->select('kode_peminjaman')
						->from('peminjaman')
						->order_by('tgl_peminjaman', 'DESC')
						->where('date(tgl_peminjaman)',$date)
						->limit(1,0)
						->get();
	}
 
	function get_barang($kode){
		return $this->db->select('*')
						->from('barang_dipinjam')
						->join('barang','barang.kode_barang = barang_dipinjam.kode_barang')
						->where('kode_peminjaman',$kode)
						->get();
	}

	function get_detail_peminjaman($kode){
		return $this->db->select('*')
						->from('peminjaman')
						->join('barang_dipinjam','barang_dipinjam.kode_peminjaman = peminjaman.kode_peminjaman')
						->join('barang','barang.kode_barang = barang_dipinjam.kode_barang')
						->where('peminjaman.kode_peminjaman',$kode)
						->get();
	}	

	function get_barang_noname($kode){
		return $this->db->select('*')
						->from('barang_dipinjam')
						->where('kode_peminjaman',$kode)
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