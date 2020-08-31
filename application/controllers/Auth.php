<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');
class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		$this->load->model('user_model');
	}

	public function index()
	{
		$data['judul'] = "Login";

		$this->load->view('admin/partials_admin/head',$data);
		$this->load->view('login',$data);
	}

	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_message('required','<div class="text text-danger">{field} Harus Diisi</div>');

		if ($this->form_validation->run() == TRUE) {
			
			$this->auth_model->login($username,$password);

		} else {
			$data['judul'] = "Login";

			$this->load->view('admin/partials_admin/head',$data);
			$this->load->view('login',$data);
		}

	}

	public function logout(){
		
		$username = $this->session->userdata('username');

		$where = array('username' => $username);
		$data = array(
			'status' => 0
		);
		$this->user_model->update($where,$data,'user');

		$this->session->sess_destroy();
		redirect('auth');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */