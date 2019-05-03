<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	function value_harga($val){
		return "Rp.".number_format($val, 0,',', '.');
	} 			
	
	function if_tanggal($tgl_update,$tgl_input){
		if (!empty($tgl_update)) {
			return $tgl_update;
		} 
		else{
			return $tgl_input;
		}
	}		