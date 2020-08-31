<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Barang extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
		$this->load->model('barang_model');

		if($this->session->userdata('role') != 'atasan'){
			show_404();
		}
		
	}

	public function index()
	{
		$data['judul'] = "Kelola Barang";
		$data['menu'] = $this->uri->segment(2);
		$data['barang'] = $this->barang_model->get_all()->result();

		$this->load->view('atasan/partials_atasan/head',$data);
		$this->load->view('atasan/partials_atasan/navbar',$data);
		$this->load->view('atasan/partials_atasan/sidebar',$data);
		$this->load->view('atasan/barang/list_barang',$data);
		$this->load->view('atasan/partials_atasan/footer',$data);
		$this->load->view('atasan/partials_atasan/script',$data);
		
	}

	public function view_detail($kode_barang){

		$where = array('kode_barang'=>$kode_barang);

		$data['judul'] = "Progress Barang";
		$data['menu'] = $this->uri->segment(2);
		$data['barang'] = $this->barang_model->get_log($where)->result();

		$this->load->view('atasan/partials_atasan/head',$data);
		$this->load->view('atasan/partials_atasan/navbar',$data);
		$this->load->view('atasan/partials_atasan/sidebar',$data);
		$this->load->view('atasan/barang/view_detail',$data);
		$this->load->view('atasan/partials_atasan/footer',$data);
		$this->load->view('atasan/partials_atasan/script',$data);

	}

}
