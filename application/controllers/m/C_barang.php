<?php
	class C_barang extends MY_Controller{

		public function __construct(){
			parent::__construct();
			//memanggil function dari controller MY_Controller
			$this->cekLogin();
			$this->load->model('member/m_barang');
			$this->load->helper(array('custom_value','tgl_indo'));
			//validasi jika session dengan level manager mengakses halaman ini maka akan dialihkan ke halaman manager
			if ($this->session->userdata('hak') == "a") {
				redirect('admin');
			}
		}

		public function barang()
		{
			$this->template->load('template/V_template_member','m/barang/V_tampil');
		}

		public function barang_ajax_get($id)
		{
			$data = $this->m_barang->get_by_id($id);
			echo json_encode($data);
		}

		public function barang_delete()
		{
			$data = $this->input->post('id');
			foreach ($data as $id) {
				$this->m_barang->delete_barang($id);
			}
		}

		public function barang_insert()
		{
			$this->_validate();
			$date = date_indo(date('Y-m-d')).','.date('h:i:s');
			$kode = $this->m_barang->code_otomatis();
			$data = array(
			'barang_id'  => $kode,
			'nama'       => $this->input->post('nama'),
			'harga_beli' => $this->input->post('hgb'),
			'harga_jual' => $this->input->post('hgj'),
			'stock'      => $this->input->post('stock'),
			'tgl_input'  => $date
			);
			$insert = $this->m_barang->insert($data);
			echo json_encode(array("status" => TRUE));
		}

		public function barang_update()
		{
			$this->_validate();
			$date = date_indo(date('Y-m-d')).','.date('h:i:s');
			$data = array(
			'nama'       => $this->input->post('nama'),
			'harga_beli' => $this->input->post('hgb'),
			'harga_jual' => $this->input->post('hgj'),
			'stock'      => $this->input->post('stock'),
			'tgl_update' => $date
			);
			$this->m_barang->update(array('id' => $this->input->post('id')), $data);
			echo json_encode(array("status" => TRUE));
		}

		public function table_list(){
			$this->datatables->select('id,barang_id,nama,harga_jual,stock,tgl_input,tgl_update');

			$this->datatables->add_column('id', '<div class="checkbox"><input type="checkbox" style="position: absolute;" value="$1" id="$1"><label for="$1"></label></div>','id');
			$this->datatables->add_column('harga_jual', '$1','value_harga(harga_jual)');
			$this->datatables->add_column('tanggal', '$1','if_tanggal(tgl_update,tgl_input)');

			$this->datatables->from('barang');

			echo $this->datatables->generate();
		}

		public function test()
		{
			header('Content-type: application/json; charset=utf-8');
			$result = $this->db->get('barang')->result_array();
			echo json_encode($result);
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

			if($this->input->post('hgb') == '')
			{
				$data['inputerror'][] = 'hgb';
				$data['status'] = FALSE;
			}

			if($this->input->post('hgj') == '')
			{
				$data['inputerror'][] = 'hgj';
				$data['status'] = FALSE;
			}

			if($this->input->post('stock') == '')
			{
				$data['inputerror'][] = 'stock';
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
