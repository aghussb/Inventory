<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_laporan_penjualan extends CI_Model {
		
		public function get_namapel()
		{
			$query = $this->db->get('pelanggan');
			if($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			return false;
		} 
		
		public function get_kodebar()
		{
			$query = $this->db->get('barang');
			if($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			return false;
		}
		
	}
