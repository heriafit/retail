<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class User extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
		$this->load->model('user_model');

		if($this->session->userdata('role') != 'admin'){
			show_404();
		}

	}

	public function index()
	{
		$data['judul'] = "Kelola user";
		$data['menu'] = $this->uri->segment(2);
		$data['user'] = $this->user_model->get_all()->result();


		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/user/list_user',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);

	}

	public function add(){
		$data['judul'] = "Kelola user";
		$data['menu'] = $this->uri->segment(2);


		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/user/add',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);
	}

	public function add_action(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');

		$this->form_validation->set_rules('username','Username','required|is_unique[user.username]');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('role','Role','required');
		$this->form_validation->set_message('required',"{field} Harus diisi");
		$this->form_validation->set_message('is_unique',"{field} sudah ada");
		$this->form_validation->set_message('max_length',"Maksimal {param} karakter");

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'username' => $username,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'role' => $role,
			);

			$this->user_model->insert($data,'user');
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Berhasil ditambahkan </div>');
			redirect('admin/user');
		} 
		else {
			$data['judul'] = "Kelola user";
			$data['menu'] = $this->uri->segment(2);


			$this->load->view('admin/partials_admin/head',$data);
			$this->load->view('admin/partials_admin/navbar',$data);
			$this->load->view('admin/partials_admin/sidebar',$data);
			$this->load->view('admin/user/add',$data);
			$this->load->view('admin/partials_admin/footer',$data);
			$this->load->view('admin/partials_admin/script',$data);
		}
	}

	public function edit($id){

		$where = array(
			'id_user' => $id
		);

		$data['judul'] = "Kelola user";
		$data['menu'] = $this->uri->segment(2);
		$data['user'] = $this->user_model->get_data($where,'user')->result();

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('admin/partials_admin/navbar',$data);
		$this->load->view('admin/partials_admin/sidebar',$data);
		$this->load->view('admin/user/edit',$data);
		$this->load->view('admin/partials_admin/footer',$data);
		$this->load->view('admin/partials_admin/script',$data);
	}

	public function update(){
		$id = $this->input->post('id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');


		$where = array('id_user'=>$id);

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('role','Role','required');
		$this->form_validation->set_message('required',"{field} Harus diisi");
		$this->form_validation->set_message('is_unique',"{field} sudah ada");
		$this->form_validation->set_message('max_length',"Maksimal {param} karakter");


		if ($this->form_validation->run() == TRUE) {

			if($password == ""){
				$data = array(
					'username' => $username,
					'role' => $role,
				);
			}
			else {
				$data = array(
					'username' => $username,
					'password' => password_hash($password, PASSWORD_DEFAULT),
					'role' => $role
				);
			}

			$this->user_model->update($where,$data,'user');
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Berhasil diperbaharui </div>');
			redirect('admin/user');

		} else {
			$data['judul'] = "Kelola user";
			$data['menu'] = $this->uri->segment(2);
			$data['user'] = $this->user_model->get_data($where,'user')->result();

			$this->load->view('admin/partials_admin/head',$data);
			$this->load->view('admin/partials_admin/navbar',$data);
			$this->load->view('admin/partials_admin/sidebar',$data);
			$this->load->view('admin/user/edit',$data);
			$this->load->view('admin/partials_admin/footer',$data);
			$this->load->view('admin/partials_admin/script',$data);
		}
	}

	public function delete($id){
		$where = array('id_user'=>$id);
		$this->user_model->delete($where,'user');
		$this->session->set_flashdata('message', '<div class="alert alert-success"> Berhasil dihapus </div>');
		redirect('admin/user');
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
			redirect('admin/user');
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
						'username' => $row['B'],
						'password'      => password_hash($row['C'], PASSWORD_DEFAULT),
						'role'      => $row['D'],
					));
				}
				$numrow++;
			}
			$this->db->insert_batch('user', $data);

			unlink(realpath('excel/'.$data_upload['file_name']));


			$this->session->set_flashdata('message', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
            //redirect halaman
			redirect('admin/user/');
		}
	}

	public function change_password(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('konfirmasi_password','Password','required|matches[password]');
		$this->form_validation->set_message('required','{field} Harus diisi');
		$this->form_validation->set_message('min_length','Password Minimal {param} karakter');
		$this->form_validation->set_message('matches','Password tidak sama');

		if ($this->form_validation->run() == TRUE) {
			$where = array('username' => $username);
			$data = array('password' => password_hash($password,PASSWORD_DEFAULT));

			$this->user_model->update($where,$data,'user');
			redirect('admin/barang');
		} else {

			$data['judul'] = "Kelola user";
			$data['menu'] = $this->uri->segment(2);
			
			$this->load->view('admin/partials_admin/head',$data);
			$this->load->view('admin/partials_admin/navbar',$data);
			$this->load->view('admin/partials_admin/sidebar',$data);
			$this->load->view('admin/user/change_password',$data);
			$this->load->view('admin/partials_admin/footer',$data);
			$this->load->view('admin/partials_admin/script',$data);
		}

		
	}

}

/* End of file user.php */
/* Location: ./application/controllers/admin/user.php */