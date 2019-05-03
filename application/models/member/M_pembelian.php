<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_pembelian extends CI_Model {
		
		var $table     = 'pembelian';
		var $table_dtl = 'dtl_pembelian';
		var $table_tbl = 'tbl_pembelian';
		var $table_lpr = 'lpr_pembelian';
		
		function getSelectID_Namasup($get){
			$this->db->from("suplier");
			$this->db->where("sup_id" , $get);
			return $this->db->get();
		}
		
		function getDataSuplier(){
			
			$query = $this->db->get('suplier');
			if($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			return false;
		}
		
		function code_otomatis(){
            $this->db->select('Right('.$this->table_lpr.'.nofak,3) as kode ',false);
            $this->db->order_by('nofak', 'desc');
            $this->db->limit(1);
			$query = $this->db->get(''.$this->table_lpr.'');
			if($query->num_rows()<>0){
				$data = $query->row();
				$kode = intval($data->kode)+1;
			}
			else{
				$kode = 1;
				
			}
			$kodemax = str_pad($kode,3,"0",STR_PAD_LEFT);
			$kodejadi  = "FKT".$kodemax;
			echo $kodejadi;
		}
		
		function getOptionID_Barang($get){
			
			$this->db->from("barang");
			$this->db->where("nama",$get);
			return $this->db->get();
		}
		
		public function get_barang()
		{
			$query = $this->db->get('barang');
			if($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			return false;
		} 
		
		public function insert_barang($data,$params)
		{
			$this->db->insert($this->table,$params);
			$this->db->insert($this->table_tbl, $data);
			
			return $this->db->insert_id();			
		}
		
		function delete_item_one($id)
		{
			$this->db->where('kodebar', $id);
			$this->db->delete(array($this->table,$this->table_tbl));
		}
		
		function update_jumlah_beli($data, $pk)
		{
			$this->db->where('id',$pk);
			$this->db->update($this->table, $data);
			return $this->db->affected_rows();
		}
		
		function delete_item_all()
		{
			$this->db->where('beli', "1");
			$this->db->delete(array($this->table,$this->table_tbl,$this->table_dtl));
		}
		
		function insert_laporan($data)
		{
			$this->db->insert($this->table_lpr, $data);
			return $this->db->insert_id();	
		}
		
		function update_barang()
		{
			$this->db->query("update barang a join ".$this->table." b on a.barang_id = b.kodebar set a.stock = b.stock_akhir WHERE b.beli = '1';");
		}
		
		function update_pembelian($data_pembelian)
		{ 
			$this->db->where('beli','1');
			$this->db->update($this->table, $data_pembelian);
			return $this->db->affected_rows();
		}
		
		function update_detail($data_detail)
		{
			$this->db->where('beli','1');
			$this->db->update($this->table_dtl, $data_detail);
			return $this->db->affected_rows();
		}
		
		function update_table($data_table)
		{
			$this->db->where('beli','1');
			$this->db->update($this->table_tbl, $data_table);
			return $this->db->affected_rows();
		}
		
	}
