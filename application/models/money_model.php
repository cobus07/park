<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 消费model
class Money_model extends CI_Model{
	// 获取 数据库 中用户消费的信息
	public function get_money(){
		$this->db->select('*');
		$this->db->from('t_user user');
		$this->db->join('t_money money', 'money.user_id=user.user_id');
		return $this->db->get()->result();
	}

	// public function post_noreserve($owner){
	// 	$data = array(
	// 		'user_id' => $owner,
	// 		'money' => '10'
	// 	);
	// 	$this->db->insert('t_money',$data);
	// 	return $row2 = $this->db->affected_rows();
	// }
}