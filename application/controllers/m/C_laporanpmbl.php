<?php
	class C_laporanpmbl extends MY_Controller{
		
		public function __construct(){
			parent::__construct();
			//memanggil function dari controller MY_Controller
			$this->cekLogin();
			
			$this->load->model('member/m_laporan_pembelian');
			//validasi jika session dengan level manager mengakses halaman ini maka akan dialihkan ke halaman manager
			if ($this->session->userdata('hak') == "a") {
				redirect('admin');
			}
		}
		
		public function lpr_pembelian()
		{
			$option_nama    = $this->m_laporan_pembelian->get_namasup();
			$option_kodebar = $this->m_laporan_pembelian->get_kodebar();
			
			$data = array(
			'option_nama'    => $option_nama,
			'option_kodebar' => $option_kodebar
			);
			
			$this->template->load('template/V_template_member','m/lprpembelian/V_tampil',$data);
		}
		
		public function table_list()
		{
			$this->datatables->select('a.nofak,b.kodebar,b.tanggal,b.namasup,b.jumlah_beli');
			$this->datatables->from('lpr_pembelian a join (pembelian b) on b.kodebar = a.kodebar and a.nofak = b.nofak');
			
			$this->db->where('b.beli','0');
			
			if ($this->input->post('nama')) {
				$this->db->like('b.namasup',$this->input->post('nama'));
			} 
			
			if ($this->input->post('tanggal')) {
				$this->db->like('a.tanggal',$this->input->post('tanggal'));
			} 
			
			if ($this->input->post('kodebar')) {
				$this->db->like('b.kodebar',$this->input->post('kodebar'));
			} 
			
			
			echo $this->datatables->generate();
		}
		
	}
?>