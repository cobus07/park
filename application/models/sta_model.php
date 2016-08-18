<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 收费标准model
class Sta_model extends CI_Model{

	public function chefeibianji($cartype, $cardtype, $money){
		$this->db->where('cartype', $cartype);
		$this->db->update('t_sta',array('unitmoney' => $money, 'cardtype' => $cardtype));
		return $this->db->affected_rows();
	}

	public function searchall(){
		return $this->db->get('t_sta')->result();
	}
}
?>