<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_penjualan extends CI_Model {
		
		var $table     = 'penjualan';
		var $table_dtl = 'dtl_penjualan';
		var $table_tbl = 'tbl_penjualan';
		var $table_lpr = 'lpr_penjualan';
		
		public function get_kodepel()
		{
			$query = $this->db->get('pelanggan');
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
		
		public function get_barang()
		{
			$query = $this->db->get('barang');
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
		
		function num_total_item(){
			$this->db->from($this->table_tbl);
			$this->db->where('beli','1');
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		function delete_item_one($id)
		{
			$this->db->where('kodebar', $id);
			$this->db->delete(array($this->table,$this->table_tbl));
			
			// $this->db->trans_start();
			// $this->db->query("delete from ".$this->table." where kodebar = '".$kodebar."';");
			// $this->db->query("delete from ".$this->table_tbl." where kodebar = '".$kodebar."';");
			// $this->db->trans_complete();
		}
		
		function delete_item_all()
		{
			$this->db->where('beli', "1");
			$this->db->delete(array($this->table,$this->table_tbl,$this->table_dtl));
		}
		
		function update_jumlah_beli($data, $pk)
		{
			$this->db->where('id',$pk);
			$this->db->update($this->table, $data);
			return $this->db->affected_rows();
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
		
		function update_penjualan($data_penjualan)
		{
			$this->db->where('beli','1');
			$this->db->update($this->table, $data_penjualan);
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
		
		function getOptionID_Barang($get){
			
			$this->db->from("barang");
			$this->db->where("nama",$get);
			return $this->db->get();
		}
		
		function getOptionID_Kodepel($get){
			
			$this->db->from("pelanggan");
			$this->db->where("plg_id",$get);
			return $this->db->get();
		}
		
	}
