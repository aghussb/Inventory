<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class M_suplier extends CI_Model {
		
		var $table = 'suplier';
		
		public function get_by_id($id)
		{
			$this->db->from($this->table);
			$this->db->where('id',$id);
			$query = $this->db->get();
			
			return $query->row();
		}
		
		public function insert($data)
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}
		
		public function update($where, $data)
		{
			$this->db->update($this->table, $data, $where);
			return $this->db->affected_rows();
		}
		
		public function delete_suplier($id)
		{
			$this->db->where('id', $id);
			$this->db->delete($this->table);
		}
		
		function code_otomatis(){
            $this->db->select('Right(suplier.sup_id,3) as kode ',false);
            $this->db->order_by('sup_id', 'desc');
            $this->db->limit(1);
            $query = $this->db->get('suplier');
            if($query->num_rows()<>0){
                $data = $query->row();
                $kode = intval($data->kode)+1;
				}else{
                $kode = 1;
				
			}
            $kodemax = str_pad($kode,3,"0",STR_PAD_LEFT);
            $kodejadi  = "SUP".$kodemax;
            return $kodejadi;
			
		}
		
		
	}
