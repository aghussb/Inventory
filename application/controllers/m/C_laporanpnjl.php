<?php
	class C_laporanpnjl extends MY_Controller{
		
		public function __construct(){
			parent::__construct();
			//memanggil function dari controller MY_Controller
			$this->cekLogin();
			$this->load->model('member/m_laporan_penjualan');
			//validasi jika session dengan level manager mengakses halaman ini maka akan dialihkan ke halaman manager
			if ($this->session->userdata('hak') == "a") {
				redirect('admin');
			}
		}
		
		public function lpr_penjualan()
		{
			$option_nama    = $this->m_laporan_penjualan->get_namapel();
			$option_kodebar = $this->m_laporan_penjualan->get_kodebar();
			
			$data = array(
			'option_nama'    => $option_nama,
			'option_kodebar' => $option_kodebar
			);
			$this->template->load('template/V_template_member','m/lprpenjualan/V_tampil',$data);
		}
		
		public function table_list()
		{
			// SELECT a.nofak,b.kodebar,b.tanggal,b.namapel,b.jumlah_beli from lpr_penjualan a join penjualan b on b.kodebar = a.kodebar and a.nofak = b.nofak where b.beli = '0'
			$this->datatables->select('a.nofak,b.kodebar,b.tanggal,b.namapel,b.jumlah_beli');
			$this->datatables->from('lpr_penjualan a join (penjualan b) on b.kodebar = a.kodebar and a.nofak = b.nofak');
			// $this->datatables->add_column('no', '$1', 'no_auto()');
			
			$this->db->where('b.beli','0');
			
			if ($this->input->post('nama')) {
				$this->db->like('b.namapel',$this->input->post('nama'));
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