<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Transaksi extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->helper(array('url','form','tanggal'));
		$this->load->library(array('form_validation','cart'));
		$this->load->model(array('barang_model','transaksi_model'));

		if($this->session->userdata('role') != 'admin'){
			show_404();
		}
		
	}

	public function index()
	{
		$data['judul'] = "Kelola Peminjaman";
		$data['menu'] = "peminjaman";
		$data['transaksi'] = $this->transaksi_model->get_all()->result();
		$data['barang'] = $this->barang_model->get_all()->result();
		

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/transaksi/list_transaksi',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);
		
	}

	public function add_action(){

		
		$nama_peminjam = $this->input->post('nama_peminjam');
		$no_hp = $this->input->post('no_hp');
		$rowid = $this->input->post('rowid');
		$jumlah = $this->input->post('jumlah');

		$this->form_validation->set_rules('nama_peminjam','Nama Peminjam','required');
		$this->form_validation->set_rules('no_hp','Kontak Peminjam','required|numeric|max_length[13]');
		$this->form_validation->set_message('required','<div class="text-danger">{field} Harus diisi</div>');
		$this->form_validation->set_message('numeric','<div class="text-danger">{field} Harus diisi Angka</div>');

		if ($this->form_validation->run() == TRUE) {


			$date = date('Y-m-d');
			$d = $this->transaksi_model->get_kode($date)->row();			

			if($d->kode_peminjaman == ""){
				$urut = 1;
			}
			else {
				$urut = substr($d->kode_peminjaman, -3)+1;
			}
			$date2 = date('Ymd');

			$data = array(
				'kode_peminjaman' => $date2.sprintf("%03d",$urut),
				'tgl_peminjaman' => date('Y-m-d H:i:s'),
				'nama_peminjam' => $nama_peminjam,
				'no_hp' => $no_hp,
				'status' => 0
			);

			$this->transaksi_model->insert($data,'peminjaman');

			
			if (!empty($rowid)) {

				foreach(array_combine($rowid, $jumlah) as $rowid=> $jumlah) {
					$data = array(
						'rowid' => $rowid,
						'qty'    => $jumlah
					);

					$this->cart->update($data);
				}
			}

			foreach($this->cart->contents() as $items){
				$data2 = array(
					'kode_peminjaman' => $date2.sprintf("%03d",$urut),
					'kode_barang' => $items['options']['kode'],
					'jumlah' => $items['qty'],
					'status' => 0
				);

				$this->transaksi_model->insert($data2,'barang_dipinjam');
			}

			$this->cart->destroy();
			
			$this->session->set_flashdata('message','<div class="alert alert-success">Berhasil diinput</div>');
			redirect('admin/transaksi');

		} else {
			$data['judul'] = "Kelola Transaksi";
			$data['menu'] = $this->uri->segment(2);
			$data['barang'] = $this->barang_model->get_all()->result();

			$this->load->view('admin/partials_admin/head',$data);
			$this->load->view('admin/partials_admin/navbar',$data);
			$this->load->view('admin/partials_admin/sidebar',$data);
			$this->load->view('admin/transaksi/add',$data);
			$this->load->view('admin/partials_admin/footer',$data);
			$this->load->view('admin/partials_admin/script',$data);
		}

	}

	public function add(){
		$data['judul'] = "Kelola Transaksi";
		$data['menu'] = $this->uri->segment(2);

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/transaksi/add',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script2',$data);
		$this->load->view('admin/partials_admin/script',$data);

	}

	public function add_barang(){

		$kode_peminjaman = $this->input->post('kode_peminjaman');
		$kode_barang = $this->input->post('kode_barang');
		$where = array('kode_barang' => $kode_barang);
		$barang = $this->barang_model->get_data($where,'barang');

		if($barang->num_rows() > 0){
			$data = array(
				'kode_peminjaman' => $kode_peminjaman,
				'kode_barang'=> $kode_barang,
				'jumlah' => 1,
				'status' => 0
			);

			$this->transaksi_model->insert($data,'barang_dipinjam');
			
		}
		else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> Kode Barang tidak ditemukan </div>');
		}
		$link = "admin/transaksi/edit/$kode_peminjaman";
		redirect($link);
	}

	public function remove($kode,$id){

		$where = array('id_barangd'=>$id);

		$this->transaksi_model->delete($where,'barang_dipinjam');

		$link = "admin/transaksi/edit/$kode";
		redirect($link);

	}


	public function edit($id){

		$where = array('kode_peminjaman'=>$id);

		$data['peminjaman'] = $this->transaksi_model->get_data($where,'peminjaman')->row();
		$data['barang'] = $this->transaksi_model->get_barang($id)->result();

		$data['judul'] = "Edit Peminjaman";
		$data['menu'] = $this->uri->segment(2);

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/transaksi/edit',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);
	}

	public function update(){

		$nama_peminjam = $this->input->post('nama_peminjam');
		$kode_peminjaman = $this->input->post('kode_peminjaman');
		$no_hp = $this->input->post('no_hp');
		$id_barang = $this->input->post('id_barang');
		$jumlah = $this->input->post('jumlah');
		
		
		$this->form_validation->set_rules('nama_peminjam','Nama Peminjam','required');
		$this->form_validation->set_rules('no_hp','Kontak Peminjam','required|numeric|max_length[13]');
		$this->form_validation->set_message('required','<div class="text-danger">{field} Harus diisi</div>');
		$this->form_validation->set_message('numeric','<div class="text-danger">{field} Harus diisi Angka</div>');

		if ($this->form_validation->run() == TRUE) {

			$where = array('kode_peminjaman' => $kode_peminjaman);

			$data = array(
				'nama_peminjam' => $nama_peminjam,
				'no_hp' => $no_hp,
			);

			$this->transaksi_model->update($where,$data,'peminjaman');

			$jml = count($id_barang);

			for($a=0;$a<$jml;$a++){

				$data2 = array(
					'jumlah' => $jumlah[$a],
					'status' => 0
				); 

				$where2 = array(
					'id_barangd' => $id_barang[$a]
				);

				$this->transaksi_model->update($where2,$data2,'barang_dipinjam');
			}
			
			$this->session->set_flashdata('message','<div class="alert alert-success">Berhasil diinput</div>');
			redirect('admin/transaksi');

		} else {
			$data['judul'] = "Kelola Transaksi";
			$data['menu'] = $this->uri->segment(2);
			$data['barang'] = $this->barang_model->get_all()->result();

			$this->load->view('admin/partials_admin/head',$data);
			$this->load->view('admin/partials_admin/navbar',$data);
			$this->load->view('admin/partials_admin/sidebar',$data);
			$this->load->view('admin/transaksi/list_transaksi',$data);
			$this->load->view('admin/partials_admin/footer',$data);
			$this->load->view('admin/partials_admin/script',$data);
		}
		
	}

	public function delete($id){

		$where = array('kode_peminjaman' => $id);

		$this->transaksi_model->delete($where,'peminjaman');
		$this->transaksi_model->delete($where,'barang_dipinjam');

		$this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil dihapus</div>');
		redirect('admin/transaksi');
	}


	public function view_detail($kode){

		$where = array('kode_peminjaman'=>$kode);

		$data['judul'] = "Detail Peminjaman";
		$data['menu'] = $this->uri->segment(2);
		$data['peminjam'] = $this->transaksi_model->get_data($where,'peminjaman')->row();
		$data['barang'] = $this->transaksi_model->get_barang($kode)->result();

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/transaksi/detail',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);

	}

	public function kembali(){

		$data['judul'] = "Pengembalian";
		$data['menu'] = "pengembalian";

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/transaksi/kembali',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);
	}

	public function kembali_action($kode){

		$where = array('kode_peminjaman' => $kode);
		$data = array('tgl_pengembalian'=>date('Y-m-d H:i:s'));
		$data2 = array('status' => 1);

		$this->transaksi_model->update($where,$data,'peminjaman');
		$this->transaksi_model->update($where,$data2,'barang_dipinjam');

		$barang = $this->transaksi_model->get_barang_noname($kode)->result();
		foreach($barang as $b){
			$jumlah = $b->jumlah;
			$this->db->query("UPDATE barang SET qty=qty+$jumlah WHERE kode_barang='$b->kode_barang'");

			$data3 = array(
				'kode_transaksi' => $kode,
				'tanggal' => date('Y-m-d H:i:s'),
				'kode_barang' => $b->kode_barang,
				'jumlah' => $jumlah,
				'ket' => 'Kembali'
			);	
			$this->transaksi_model->insert($data3,'logging_barang');
		}

		$this->session->set_flashdata('message','<div class="alert alert-success">Barang Telah Kembali</div>');
		redirect('admin/transaksi');
	}

	public function cetak($kode){
		$where = array('kode_peminjaman'=>$kode);

		$data['judul'] = "Detail Peminjaman";
		$data['menu'] = $this->uri->segment(2);
		$data['peminjam'] = $this->transaksi_model->get_data($where,'peminjaman')->row();
		$data['barang'] = $this->transaksi_model->get_barang($kode)->result();

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/transaksi/cetak',$data);
		$this->load->view('admin/partials_admin/script',$data);
	}

}
