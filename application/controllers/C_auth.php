<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class C_auth extends CI_Controller
	{

		public function __construct(){
			parent::__construct();
			$this->load->model(array('M_auth'));
		}

		public function cekAkun()
		{
			//membuat validasi login
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$query = $this->M_auth->cekAkun($username, $password);

			if ($query === 1) {
				echo '
				<div class="alert alert-danger alert-dismissible fade in dttdk" data-auto-dismiss="2000" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<b>Data</b>
				<br/>
				<p>Tidak Ditemukan</p>
				</div>
				';
			}
			else if ($query === 2) {
				echo "User Tidak Aktif!";
			}
			else if ($query === 3) {
				echo '
				<div class="alert alert-danger alert-dismissible fade in passwr" data-auto-dismiss="2000" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<b>Password</b>
				<br/>
				<p>Salah</p>
				</div>
				';
			}
			else if ($query === 4) {
				return '<h1>Anda Diblokir </h1>';
			}
			else {
				//membuat session dengan nama userdata
				$userData = array(
				'username'  => $query->username,
				'nama'      => $query->nama,
				'hak'       => $query->hak,
				'logged_in' => TRUE
				);
				$this->session->set_userdata($userData);
				return TRUE;
			}
		}

		public function login()
		{
			//melakukan pengalihan halaman sesuai dengan levelnya
			if ($this->session->userdata('hak') == "m"){
				redirect('member');
			}

			//proses login dan validasi nya
			if ($this->input->post('submit')) {
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				$error = $this->cekAkun();
				if ($this->form_validation->run() && $error === TRUE) {
					$data = $this->M_auth->cekAkun(
					$this->input->post('username'),
					$this->input->post('password')
					);

					//jika bernilai TRUE maka alihkan halaman sesuai dengan level nya
					if($data->hak == 'm'){
						redirect('member');
					}
				}

				//Jika bernilai FALSE maka tampilkan error
				else{
					$data['error'] = $error;
					//$this->load->view('auth/V_login', $data);
					$this->template->load('template/V_template_login','auth/V_tampil', $data);
				}
			}
			//Jika tidak maka alihkan kembali ke halaman login
			else{
				//$this->load->view('auth/V_login');
				$this->template->load('template/V_template_login','auth/V_tampil');
			}
		}


		public function logout()
		{
			//Menghapus semua session (sesi)
			$this->session->sess_destroy();
			redirect('login');
		}

		public function register(){
			$this->template->load('template/V_template_login','auth/V_register');
		}

		public function add(){
			$this->M_auth->save();
			echo '
			<div class="alert alert-success alert-dismissible fade in bhrgst" data-auto-dismiss="2000" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<b>Register</b>
			<br/>
			<p>Berhasil</p>
			</div>
			';
			$this->template->load('template/V_template_login','auth/V_tampil');
		}

		public function forget(){
			if ($this->input->post('for')) {
				$email =  $this->input->post('email');
				$this->db->from('users');
				$this->db->where('email', $email);
				$rawdata = $this->db->get();

				if($rawdata->num_rows() > 0){
					foreach($rawdata->result_array() as $row)
					{
						$username =  $row['username'];
						$cost = rand(8, 11);
						$options = [
						'cost'   => $cost,
						];
						$hash =  password_hash($username, PASSWORD_DEFAULT,$options);

						$params=array(
						'password'=>$hash
						);

						$this->db->where('email',$email);
						$this->db->update('users',$params);
					}
					echo '
					<div class="alert alert-success alert-dismissible fade in bheml" data-auto-dismiss="2000" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<b>Email</b>
					<br/>
					<p>Berhasil Diubah</p>
					</div>
					';
					$this->template->load('template/V_template_login','auth/V_tampil');
				}
				else{
					echo '
				<div class="alert alert-danger alert-dismissible fade in emtdk" data-auto-dismiss="2000" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<b>Email</b>
				<br/>
				<p>Tidak Ditemukan</p>
				</div>
				';
				$this->template->load('template/V_template_login','auth/V_tampil');
				}
	 		}
	}
}
