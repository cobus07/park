<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// car表
class Car_model extends CI_Model{

	// 从数据库查询所有的车位
	public function search_car(){
		return $this->db->get('t_park')->result();
	}
}
