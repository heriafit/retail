<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Barang extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
		$this->load->model(array('barang_model','transaksi_model'));

		if($this->session->userdata('role') != 'admin'){
			show_404();
		}
		
	}

	public function index()
	{
		$data['judul'] = "Master Data Barang";
		$data['menu'] = "master_data";
		$data['barang'] = $this->barang_model->get_all()->result();

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/barang/list_barang',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);
		
	}

	public function add(){
		$data['judul'] = "Tambah Barang";
		$data['menu'] = $this->uri->segment(2);

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/barang/add',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);
	} 

	public function add_action(){

		$kode_barang = $this->input->post('kode_barang');
		$nama_barang = $this->input->post('nama_barang');
		$qty = $this->input->post('qty');
		$satuan = $this->input->post('satuan');

		$this->form_validation->set_rules('kode_barang','Kode Barang','required|is_unique[barang.kode_barang]');
		$this->form_validation->set_rules('nama_barang','Nama Barang','required');
		$this->form_validation->set_rules('qty','Jumlah Barang','required|numeric');
		$this->form_validation->set_rules('satuan','Satuan Barang','required');
		$this->form_validation->set_message('required','<div class="text-danger">{field} Harus diisi</div>');
		$this->form_validation->set_message('numeric','<div class="text-danger">{field} Harus diisi Angka</div>');
		$this->form_validation->set_message('is_unique','<div class="text-danger">{field} sudah ada</div>');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'kode_barang' => $kode_barang,
				'nama_barang' => $nama_barang,
				'qty' => $qty,
				'satuan' => $satuan
			);

			$this->barang_model->insert($data,'barang');
			$this->session->set_flashdata('message','<div class="alert alert-success">Berhasil diinput</div>');
			redirect('admin/barang');

		} else {
			$data['judul'] = "Tambah Barang";
			$data['menu'] = $this->uri->segment(2);

			$this->load->view('admin/partials_admin/head',$data);
			$this->load->view('admin/partials_admin/navbar',$data);
			$this->load->view('admin/partials_admin/sidebar',$data);
			$this->load->view('admin/barang/add',$data);
			$this->load->view('admin/partials_admin/footer',$data);
			$this->load->view('admin/partials_admin/script',$data);
		}

	}


	public function edit($id){

		$where = array('id_barang'=>$id);
		
		$data['barang'] = $this->barang_model->get_data($where,'barang')->result();

		$data['judul'] = "Edit Barang";
		$data['menu'] = $this->uri->segment(2);

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/barang/edit',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);
	}

	public function update(){

		$id_barang = $this->input->post('id_barang');
		$kode_barang = $this->input->post('kode_barang');
		$nama_barang = $this->input->post('nama_barang');
		$qty = $this->input->post('qty');
		$satuan = $this->input->post('satuan');

		$this->form_validation->set_rules('kode_barang','Kode Barang','required');
		$this->form_validation->set_rules('nama_barang','Nama Barang','required');
		$this->form_validation->set_rules('qty','Jumlah Barang','required|numeric');
		$this->form_validation->set_rules('satuan','Satuan Barang','required');
		$this->form_validation->set_message('required','{field} Harus diisi');
		$this->form_validation->set_message('numeric','{field} Harus diisi Angka');

		if ($this->form_validation->run() == TRUE) {

			$where = array('id_barang' => $id_barang);

			$data = array(
				'kode_barang' => $kode_barang,
				'nama_barang' => $nama_barang,
				'qty' => $qty,
				'satuan' => $satuan
			);

			$this->barang_model->update($where,$data,'barang');
			$this->session->set_flashdata('message','<div class="alert alert-success">Berhasil diperbaharui</div>');
			redirect('admin/barang');

		} else {
			$data['judul'] = "Edit Barang";
			$data['menu'] = $this->uri->segment(2);
			$data['barang'] = $this->barang_model->get_data($where,'barang')->result();

			$this->load->view('admin/partials_admin/head',$data);
			$this->load->view('admin/partials_admin/navbar',$data);
			$this->load->view('admin/partials_admin/sidebar',$data);
			$this->load->view('admin/barang/edit',$data);
			$this->load->view('admin/partials_admin/footer',$data);
			$this->load->view('admin/partials_admin/script',$data);
		}
	}

	public function delete($id){
		$where = array('id_barang' => $id);
		$this->barang_model->delete($where,'barang');
		$this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil dihapus</div>');
		redirect('admin/barang');
	}


	public function view_detail($kode_barang){

		$where = array('logging_barang.kode_barang'=>$kode_barang);

		$data['judul'] = "Progress Barang";
		$data['menu'] = $this->uri->segment(2);
		$data['barang'] = $this->barang_model->get_log($where)->result();

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/barang/view_detail',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);

	}

	public function barang_masuk(){
		$data['judul'] = "Barang Masuk";
		$data['menu'] = "barang_masuk";
		$data['barang'] = $this->barang_model->get_all()->result();

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/barang/add_barang_masuk',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);

	}

	public function add_action_masuk(){
		
		$kode_barang = $this->input->post('kode_barang');
		$jumlah = $this->input->post('jumlah');
		$nama_pengirim = $this->input->post('nama_pengirim');
		$no_hp = $this->input->post('no_hp');

		$date = date('Y-m-d');
		$d = $this->barang_model->get_kode($date)->row();			

		if($d->kode_penerimaan == ""){
			$urut = 1;
		}
		else {
			$urut = substr($d->kode_penerimaan, -3)+1;
		}
		$date2 = date('Ymd');
		$kode_penerimaan = "IN_".$date2.sprintf("%03d",$urut);

		$data = array(
			'kode_penerimaan' => $kode_penerimaan,
			'tgl_penerimaan' => date('Y-m-d H:i:s'),
			'nama_pengirim' => $nama_pengirim,
			'no_hp' => $no_hp,
			'jumlah' => $jumlah
		);

		$this->barang_model->insert($data,'barang_masuk');
		$this->db->query("UPDATE barang SET qty=qty+$jumlah WHERE kode_barang='$kode_barang'");

		$data3 = array(
			'kode_transaksi' => $kode_penerimaan,
			'tanggal' => date('Y-m-d H:i:s'),
			'kode_barang' => $kode_barang,
			'jumlah' => $jumlah,
			'ket' => 'Barang Masuk'
		);	

		$this->barang_model->insert($data3,'logging_barang');
		$this->session->set_flashdata('message','<div class="alert alert-success">Berhasil ditambahkan</div>');
			redirect('admin/barang');
	}

	public function import(){

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';


		$config['upload_path'] = realpath('excel');
		$config['allowed_types'] = 'xls|csv';
		$config['max_size']  = '10000';
		$config['encrypt_name'] = true;


		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('import_files')){
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
			redirect('admin/barang');
		}
		else{
			$data_upload = $this->upload->data();
			$excelreader     = new PHPExcel_Reader_Excel5();
			$loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']); 
			$sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

			$data = array();
			$numrow = 1;
			foreach($sheet as $row){
				if($numrow > 1){
					array_push($data, array(
						'kode_barang' => $row['B'],
						'nama_barang'      => $row['C'],
						'qty'      => $row['D'],
						'satuan'      => $row['E'],
					));
				}
				$numrow++;
			}
			$this->db->insert_batch('barang', $data);

			unlink(realpath('excel/'.$data_upload['file_name']));


			$this->session->set_flashdata('message', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
            //redirect halaman
			redirect('admin/barang/');
		}
	}

	public function hello(){
		echo "hello";
	} 	

}
