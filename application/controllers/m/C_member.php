<?php
	class C_member extends MY_Controller{
		
		public function __construct(){
			parent::__construct();
			
			//memanggil function dari controller MY_Controller
			$this->cekLogin();
			
			//validasi jika session dengan level manager mengakses halaman ini maka akan dialihkan ke halaman manager
			if ($this->session->userdata('hak') == "a") {
				redirect('admin');
			}
		}
		
		public function member()
		{
			$this->template->load('template/V_template_member','m/V_tampil');
		}
	}
?>