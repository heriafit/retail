<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Transaksi extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->helper(array('url','form','tanggal'));
		$this->load->library(array('form_validation','cart'));
		$this->load->model(array('barang_model','transaksi_model'));

		if($this->session->userdata('role') != 'atasan'){
			show_404();
		}
		
	}

	public function index()
	{
		$data['judul'] = "Transaksi Peminjaman";
		$data['menu'] = $this->uri->segment(2);
		$data['transaksi'] = $this->transaksi_model->get_all()->result();
		$data['barang'] = $this->barang_model->get_all()->result();
		

		$this->load->view('atasan/partials_atasan/head',$data);
		$this->load->view('atasan/partials_atasan/navbar',$data);
		$this->load->view('atasan/partials_atasan/sidebar',$data);
		$this->load->view('atasan/transaksi/list_transaksi',$data);
		$this->load->view('atasan/partials_atasan/footer',$data);
		$this->load->view('atasan/partials_atasan/script',$data);
		
	}


	public function view_detail($kode){

		$where = array('kode_peminjaman'=>$kode);

		$data['judul'] = "Detail Peminjaman";
		$data['menu'] = $this->uri->segment(2);
		$data['peminjam'] = $this->transaksi_model->get_data($where,'peminjaman')->row();
		$data['barang'] = $this->transaksi_model->get_barang($kode)->result();

		$this->load->view('atasan/partials_atasan/head',$data);
		$this->load->view('atasan/partials_atasan/navbar',$data);
		$this->load->view('atasan/partials_atasan/sidebar',$data);
		$this->load->view('atasan/transaksi/detail',$data);
		$this->load->view('atasan/partials_atasan/footer',$data);
		$this->load->view('atasan/partials_atasan/script',$data);

	}

	public function approve($kode){
		$where = array('kode_peminjaman'  => $kode);
		$data = array('status' => 1, 'tgl_peminjaman'=>date('Y-m-d H:i:s'));
		$this->transaksi_model->update($where,$data,'peminjaman');

		
		$barang = $this->transaksi_model->get_barang_noname($kode)->result();
		foreach($barang as $b){
			$jumlah = $b->jumlah;
			$this->db->query("UPDATE barang SET qty=qty-$jumlah WHERE kode_barang='$b->kode_barang'");

			$data3 = array(
				'kode_transaksi' => $kode,
				'tanggal' => date('Y-m-d H:i:s'),
				'kode_barang' => $b->kode_barang,
				'jumlah' => $jumlah,
				'ket' => 'Dipinjam'
			);	

			$this->transaksi_model->insert($data3,'logging_barang');
		}
		

		$this->session->set_flashdata('message','<div class="alert alert-success">Berhasil disetujui</div>');
		redirect('atasan/transaksi');
	}

}
