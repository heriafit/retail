<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('barang_model');
		$this->load->library(array('cart','form_validation'));
		$this->load->helper('url');

		if($this->session->userdata('role') != 'admin'){
			show_404();
		}
	}

	public function add()
	{
		$kode_barang = $this->input->post('kode_barang');

		$this->form_validation->set_rules('kode_barang','Kode Barang','required');
		$this->form_validation->set_message('required','<div class="text-danger">{field} Harus Diisi</div>');

		if ($this->form_validation->run() == TRUE) {
			$where = array('kode_barang' => $kode_barang);
			$barang = $this->barang_model->get_data($where,'barang');


			if($barang->num_rows() > 0){

				$barang = $this->barang_model->get_data($where,'barang')->row();

				if($barang->qty == 0){
					$this->session->set_flashdata('message', '<div class="alert alert-danger"> Stok Barang Kosong </div>');
					redirect('admin/transaksi/add');
				}
				else {
					$jumlah = 1;
				}

				$data = array(
					'id' => $barang->id_barang,
					'name' => $barang->nama_barang,
					'price' => '',
					'qty' => $jumlah,
					'options' => array('kode' => $barang->kode_barang,'stok'=>$barang->qty)
				);

				$this->cart->insert($data);
			}
			else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> Kode Barang tidak ditemukan </div>');
			}

			redirect('admin/transaksi/add');
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

	public function remove($id){
		$data = array(
			'rowid' => $id,
			'qty' => 0
		);

		$this->cart->update($data);
		redirect('admin/transaksi/add');
	}

}

/* End of file Cart.php */
/* Location: ./application/controllers/admin/Cart.php */