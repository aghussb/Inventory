<?php
	class C_pembelian extends MY_Controller{
		
		public function __construct(){
			parent::__construct();
			//memanggil function dari controller MY_Controller
			$this->cekLogin();
			$this->load->model('member/m_pembelian');
			$this->load->helper(array('tgl_indo','custom_value'));
			//validasi jika session dengan level manager mengakses halaman ini maka akan dialihkan ke halaman manager
			if ($this->session->userdata('hak') == "a") {
				redirect('admin');
			}
		}
		
		public function pembelian()
		{
			$tanggal  = date_indo(date('Y-m-d'));
			$option = $this->m_pembelian->getDataSuplier();
			$namabar  = $this->m_pembelian->get_barang();
			
			$data = array(
			'tanggal'     => $tanggal,
			'option'      => $option,
			'namabar'     => $namabar
			); 
			
			$this->template->load('template/V_template_member','m/pembelian/V_tampil',$data);
		}
		
		public function table_list(){
			
			$this->datatables->select('a.kodebar, a.namabar, a.harga_beli, b.jumlah_beli, a.stock, b.stock_akhir, b.total_bayar,b.id');
			$this->datatables->from('tbl_pembelian as a JOIN (pembelian as b) ON a.kodebar = b.kodebar');
			$this->db->where('a.beli = "1" and b.beli = "1"');
			
			$this->datatables->add_column('harga_beli', '$1','value_harga(harga_beli)');
			$this->datatables->add_column('total_bayar', '$1','value_harga(total_bayar)');
			$this->datatables->add_column('jumlah_beli', '<a data-type="text" data-name="jumlah_beli" onclick="update_jumlah_beli(this);" data-pk="$1" data-placeholder="Enter Username" style="text-decoration:none;border-bottom:none;color:#333;cursor: pointer;" data-title="Enter Username">$2</a>','id,jumlah_beli');
			$this->datatables->add_column('delete', '<center><button class="btn btn-sm btn-default" type="button" onclick="delete_barang('."'$1'".')"><i class="glyphicon glyphicon-remove"></i></a></center>','kodebar');
			
			echo $this->datatables->generate();
		}
		
		public function getOptionSelectNamasup()
		{
			$get = $_GET['kode'];
			
			$data = $this->m_pembelian->getSelectID_Namasup($get)->row();
			echo json_encode($data);
			
			exit;
		}
		
		public function nofak()
		{
			$nofak = $this->m_pembelian->code_otomatis();
			echo $nofak;
		}
		
		public function getOptionSelectBarang()
		{
			$get = $_GET['nama'];
			
			$data = $this->m_pembelian->getOptionID_Barang($get)->row();
			echo json_encode($data);
			
			exit;
		}
		
		public function add_barang()
		{
			$this->_validate_modal();
			$kodebar = $this->input->post('kodebar');
			
			$params = array(
			'kodebar'        => $this->input->post('kodebar'),
			'stock_akhir'    => "0",
			'jumlah_beli'    => "0",
			'total_bayar'    => "0",
			'beli'           => "1"
			);
			
			$data = array(
			'kodebar'        => $this->input->post('kodebar'),
			'namabar'        => $this->input->post('barang'),
			'harga_beli'     => $this->input->post('hgb'),
			'stock'          => $this->input->post('stock'),
			'beli'           => "1"
			);
			
			$this->db->select("kodebar");
			$this->db->from('tbl_pembelian');
			$this->db->where('kodebar', $kodebar);
			$this->db->where('beli', "1");
			
			$cekdata   = $this->db->get();
			
			
			if($cekdata->num_rows() > 0){
				echo json_encode(array("sudah" => TRUE));
			} 
			else{
				$this->db->select("nofak");
				$this->db->from('dtl_pembelian');
				$this->db->where('nofak', "");
				
				$ceknofak   = $this->db->get();
				if ($ceknofak->num_rows() > 0) {
					$insert = $this->m_pembelian->insert_barang($data,$params);
					echo json_encode(array("status" => TRUE));
				}
				else{
					$this->db->insert('dtl_pembelian', array('total_semua_bayar' => "0" , 'beli' => "1"));	
					$insert = $this->m_pembelian->insert_barang($data,$params);
					echo json_encode(array("status" => TRUE));
				}
			}
		}
		
		public function update_x()
		{
			// $jumlah_beli = $this->input->post('jumlah_beli');
			$value       = $this->input->post('value');
			$pk          = $this->input->post('pk');
			
			$query   = $this->db->query("SELECT a.kodebar,b.kodebar,a.harga_beli,a.stock,a.beli,b.id,b.beli FROM tbl_pembelian a JOIN pembelian b ON a.kodebar = b.kodebar where a.beli ='1' and b.id='$pk'");
			$row     = $query->row_array();
			
			$hgb  = $row['harga_beli'];
			$ttb  = $hgb * $value; //Hasil Total Bayar
			$stk  = $row['stock'];
			$stka = $stk + $value; //Hasil Stock Akhir
			
			$data = array(
			'jumlah_beli' => $value,
			'stock_akhir' => $stka,
			'total_bayar' => $ttb
			);
			
			$update = $this->m_pembelian->update_jumlah_beli($data, $pk);
			echo json_encode(array("status" => TRUE));
			
		}
		
		public function delete_item($id)
		{
			$this->m_pembelian->delete_item_one($id);
			echo json_encode(array("status" => TRUE));
		}
		
		public function delete_item_all()
		{
			$this->m_pembelian->delete_item_all();
			echo json_encode(array("status" => TRUE));
		}
		
		public function total_bayar()
		{
			// SELECT sum(total_bayar) FROM penjualan where beli = '1'
			$query = $this->db->query("SELECT sum(total_bayar) FROM pembelian where beli = '1'");
			foreach ($query->result_array() as $row)
			{
				echo $row['sum(total_bayar)'];
			}
		}
		
		public function save_all()
		{
			$this->_validate_save_all();
			$nofak   = $this->input->post('nofak');
			$kodesup = $this->input->post('kodesup');
			$tanggal = $this->input->post('hari');
			$namasup = $this->input->post('namasup');
			$ttitm   = $this->input->post('ttitm');
			$timestamp = date("d-m-Y");
			
			$query = $this->db->query("SELECT sum(total_bayar) FROM pembelian where beli = '1'");
			foreach ($query->result_array() as $row)
			{
				$total_bayar = $row['sum(total_bayar)'];
			}
			
			$query2 = $this->db->query("SELECT b.kodebar from barang a join pembelian b on a.barang_id = b.kodebar where b.beli ='1'");
			foreach ($query2->result_array() as $row)
			{
				// Insert Laporan
				
				$kodebar = $row['kodebar'];
				$data = array(
				'nofak' => $nofak,
				'kodebar' => $kodebar,
				'tanggal' => $timestamp
				);
				
				$this->m_pembelian->insert_laporan($data);
			}
			
			// Update Barang
			$this->m_pembelian->update_barang();
			
			// Update Pembelian
			$data_pembelian = array(
			'nofak'   => $nofak,
			'tanggal' => $tanggal,
			'kodesup' => $kodesup,
			'namasup' => $namasup,
			'beli'    => "0"
			);
			
			$this->m_pembelian->update_pembelian($data_pembelian);
			
			// Update Detail
			$data_detail = array(
			'nofak'             => $nofak,
			'total_semua_item'  => $ttitm,
			'total_semua_bayar' => $total_bayar,
			'beli'              => "0"
			);
			
			$this->m_pembelian->update_detail($data_detail);
			
			// Update Table
			$data_table = array(
			'namasup'             => $namasup,
			'beli'                => "0"
			);
			
			$this->m_pembelian->update_table($data_table);
			echo json_encode(array("status" => TRUE));
			
		}
		
		private function _validate_modal()
		{
			$data = array();
			$data['error_string'] = array();
			$data['inputerror'] = array();
			$data['status'] = TRUE;
			
			if($this->input->post('kodebar') == '')
			{
				$data['inputerror'][] = 'kodebar';
				// $data['error_string'][] = 'kodebar';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('barang') == '')
			{
				$data['inputerror'][] = 'barang';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('hgb') == '')
			{
				$data['inputerror'][] = 'hgb';
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
		
		private function _validate_save_all()
		{
			$data = array();
			$data['error_string'] = array();
			$data['inputerror'] = array();
			$data['status'] = TRUE;
			
			/* if($this->input->post('kodebar') == '')
				{
				$data['inputerror'][] = 'kodebar';
				$data['status'] = FALSE;
			} */
			
			if($this->input->post('namasup') == '')
			{
				$data['inputerror'][] = 'namasup';
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