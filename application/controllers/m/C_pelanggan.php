<?php
	class C_pelanggan extends MY_Controller{
		
		public function __construct(){
			parent::__construct();
			//memanggil function dari controller MY_Controller
			$this->cekLogin();
			$this->load->model('member/m_pelanggan');
			$this->load->helper(array('custom_value','tgl_indo'));
			//validasi jika session dengan level manager mengakses halaman ini maka akan dialihkan ke halaman manager
			if ($this->session->userdata('hak') == "a") {
				redirect('admin');
			}
		}
		
		public function pelanggan()
		{
			$this->template->load('template/V_template_member','m/pelanggan/V_tampil');
		}
		
		public function get_id($id)
		{
			$data = $this->m_pelanggan->get_by_id($id);
			echo json_encode($data);
		}
		
		public function pelanggan_insert()
		{
			$this->_validate();
			$date = date_indo(date('Y-m-d')).','.date('h:i:s');
			$kode = $this->m_pelanggan->code_otomatis();
			$data = array(
			'plg_id'     => $kode,
			'nama'       => $this->input->post('nama'),
			'alamat'     => $this->input->post('alamat'),
			'telp'       => $this->input->post('telp'),
			'tgl_input'  => $date
			);
			$insert = $this->m_pelanggan->insert($data);
			echo json_encode(array("status" => TRUE));
		}
		
		public function pelanggan_update()
		{
			$this->_validate();
			$date = date_indo(date('Y-m-d')).','.date('h:i:s');
			$data = array(
			'nama'       => $this->input->post('nama'),
			'alamat'     => $this->input->post('alamat'),
			'telp'       => $this->input->post('telp'),
			'tgl_update' => $date
			);
			$this->m_pelanggan->update(array('id' => $this->input->post('id')), $data);
			echo json_encode(array("status" => TRUE));
		}
		
		public function pelanggan_delete()
		{
			$data = $this->input->post('id');
			foreach ($data as $id) {
				$this->m_pelanggan->delete_pelanggan($id);
			}
		}
		
		public function table_list(){
			$this->datatables->select('id,plg_id,nama,alamat,telp,tgl_input,tgl_update');
			
			$this->datatables->add_column('id', '<div class="checkbox"><input type="checkbox" style="position: absolute;" value="$1" id="$1"><label for="$1"></label></div>','id');
			$this->datatables->add_column('tanggal', '$1','if_tanggal(tgl_update,tgl_input)');
			
			$this->datatables->from('pelanggan');
			
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