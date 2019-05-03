<?php
	class C_suplier extends MY_Controller{
		
		public function __construct(){
			parent::__construct();
			//memanggil function dari controller MY_Controller
			$this->cekLogin();
			$this->load->model('member/m_suplier');
			$this->load->helper(array('custom_value','tgl_indo'));
			//validasi jika session dengan level manager mengakses halaman ini maka akan dialihkan ke halaman manager
			if ($this->session->userdata('hak') == "a") {
				redirect('admin');
			}
		}
		
		public function suplier()
		{
			$this->template->load('template/V_template_member','m/suplier/V_tampil');
		}
		
		public function get_id($id)
		{
			$data = $this->m_suplier->get_by_id($id);
			echo json_encode($data);
		}
		
		public function suplier_insert()
		{
			$this->_validate();
			$date = date_indo(date('Y-m-d')).','.date('h:i:s');
			$kode = $this->m_suplier->code_otomatis();
			$data = array(
			'sup_id'     => $kode,
			'nama'       => $this->input->post('nama'),
			'alamat'     => $this->input->post('alamat'),
			'telp'       => $this->input->post('telp'),
			'tgl_input'  => $date
			);
			$insert = $this->m_suplier->insert($data);
			echo json_encode(array("status" => TRUE));
		}
		
		public function suplier_update()
		{
			$this->_validate();			
			$date = date_indo(date('Y-m-d')).','.date('h:i:s');
			$data = array(
			'nama'       => $this->input->post('nama'),
			'alamat'     => $this->input->post('alamat'),
			'telp'       => $this->input->post('telp'),
			'tgl_update' => $date
			);
			$this->m_suplier->update(array('id' => $this->input->post('id')), $data);
			echo json_encode(array("status" => TRUE));
		}
		
		public function suplier_delete()
		{
			$data = $this->input->post('id');
			foreach ($data as $id) {
				$this->m_suplier->delete_suplier($id);
			}
		}
		
		public function table_list(){
			$this->datatables->select('id,sup_id,nama,alamat,telp,tgl_input,tgl_update');
			
			$this->datatables->add_column('id', '<div class="checkbox"><input type="checkbox" style="position: absolute;" value="$1" id="$1"><label for="$1"></label></div>','id');
			$this->datatables->add_column('tanggal', '$1','if_tanggal(tgl_update,tgl_input)');
			
			$this->datatables->from('suplier');
			
			echo $this->datatables->generate();
		}
		
		private function _validate()
		{
			$data = array();
			$data['error_string'] = array();
			$data['inputerror'] = array();
			$data['status'] = TRUE;
			
			if($this->input->post('nama') == '')
			{
				$data['inputerror'][] = 'nama';
				// $data['error_string'][] = '❌';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('alamat') == '')
			{
				$data['inputerror'][] = 'alamat';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('telp') == '')
			{
				$data['inputerror'][] = 'telp';
				$data['status'] = FALSE;
			}
			
			if($data['status'] === FALSE)
			{
				echo json_encode($data);
				exit();
			}
			
		}
	}
?>						