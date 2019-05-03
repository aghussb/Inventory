<?php
	class M_auth extends CI_Model {

		//mengambil tabel users
		public $table = 'users';

		public function cekAkun($username, $password)
		{
			//cari username lalu lakukan validasi
			$this->db->where('username', $username);
			$query = $this->db->get($this->table)->row();

			//jika bernilai 1 maka user tidak ditemukan
			if (!$query)return 1;

			//jika bernilai 2 maka user tidak aktif
			if ($query->aktif == 0) return 2;

			//jika bernilai 3 maka password salah
			$hash = $query->password;
			if (!password_verify($password,$hash)) return 3;

			return $query;
		}

		public function save(){
			$password = $this->input->post('password');

			$cost = rand(8, 11);
			$options = [
			'cost'   => $cost,
			];

			$hash =  password_hash($password, PASSWORD_DEFAULT,$options);

			$params = array(
			'username' => $this->input->post('username'),
			'nama'     => $this->input->post('nama'),
			'email'    => $this->input->post('email'),
			'password' => $hash,
			'hak'      => 'm',
			'aktif'    => '1'
			);
			$this->db->insert('users',$params);
		}
	}																																
