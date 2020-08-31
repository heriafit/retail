<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function login($username,$password){

		$this->db->select('*')->from('user')->where('username',$username);

		$user = $this->db->get()->row();

		if(!empty($user)){
			$verify = password_verify($password,$user->password);

			if($verify){
				$this->session->set_userdata('logged_in',TRUE);
				$this->session->set_userdata('role',$user->role);
				$this->session->set_userdata('username',$user->username);

				$this->load->model('user_model');

				$where = array('username' => $username);
				$data = array(
					'last_login' => date('Y-m-d H:i:s'),
					'status' => 1
				);

				$this->user_model->update($where,$data,'user');

				if($user->role == 'admin'){
					redirect('admin/barang');
				}
				if($user->role == 'atasan'){
					redirect('atasan/barang');
				}

			}
			else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Username / Password Salah</div>');
				redirect('auth');
			}
		}
		$this->session->set_flashdata('message', '<div class="alert alert-danger">User tidak ditemukan</div>');
		redirect('auth');

	}	

}

/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */