<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class User extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
		$this->load->model('user_model');

		if($this->session->userdata('role') != 'atasan'){
			show_404();
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
			redirect('atasan/barang');
		} else {

			$data['judul'] = "Kelola user";
			$data['menu'] = $this->uri->segment(2);
			
			$this->load->view('atasan/partials_atasan/head',$data);
			$this->load->view('atasan/partials_atasan/navbar',$data);
			$this->load->view('atasan/partials_atasan/sidebar',$data);
			$this->load->view('atasan/user/change_password',$data);
			$this->load->view('atasan/partials_atasan/footer',$data);
			$this->load->view('atasan/partials_atasan/script',$data);
		}

		
	}

}

/* End of file user.php */
/* Location: ./application/controllers/admin/user.php */