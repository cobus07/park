<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 积分model
class Record_model extends CI_Model{

	// 获取积分记录
	public function get_record(){
		$this->db->select('*');
		$this->db->from('t_user user');
		$this->db->join('t_record record', 'record.user_id=user.user_id');
		// 返回一个结果集
		return $this->db->get()->result();
	}

	// 管理积分记录
	public function adminrecord($userid,$record,$addtime){
		$arr = array(
            'record' => $record,
            'addtime' => $addtime
        );
        $this->db->where('user_id',$userid);
        $this->db->update('t_record',$arr);
        // 返回影响的行数
        return $row = $this->db->affected_rows();
	}

	// 积分记录编辑
	public function bianjirecord($userid){
		$arr = array(
            'user_id' => $userid,
        );
        return $this->db->get_where('t_record',$arr)->result();
	}
}