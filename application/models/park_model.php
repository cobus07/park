<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 停车场model
class Park_model extends CI_Model{

	// 查询 数据库中所有车位的状态
	public function searchall(){
		return $this->db->get('t_park')->result();
	}

	// AJAX形式获取 已占车位
	public function ajax_get_reserve_b($status_b){
		$query = $this->db->query("select * from t_park where status='$status_b'");
		$result = $query->result();
		return $result;
	}

	// AJAX形式获取 未占车位
	public function ajax_get_reserve_w($status_w){
		$query = $this->db->query("select * from t_park where status='$status_w'");
		$result = $query->result();
		return $result;
	}

	// 预定车位 更改数据库里面的车位的状态
	public function post_reserve($reserve_id,$user_id){
		$this->db->where('number', $reserve_id);
		$this->db->update('t_park',array('status' => 'black', 'owner' => $user_id));
		// $this->db->where('owner', $user_id);
		// $this->db->insert('t_car', array('owner' => $user_id, 'intime' => $intime));
		return $this->db->affected_rows();
	}

	//  获取 车位状态
	public function get_reserve($userid){
		// $arr = array(
		// 		'user_id' => $userid
		// 	);
		// return $this->db->get_where('t_park',$arr)->result();
		$query = $this->db->query("select * from t_park where owner='$userid'");
		$result = $query->result();
		return $result;
	}

	// 获取消费记录
	public function get_money($userid){
		$this->db->order_by("addtime","desc");
		$query = $this->db->query("select * from t_money where user_id='$userid'");
		$result = $query->result();
		return $result;
	}


	// 获取积分记录
	public function get_record($userid){
		$query = $this->db->query("select * from t_record where user_id='$userid'");
		$result = $query->result();
		return $result;
	}

	// 获取停车场车位信息
	public function get_cars(){
		return $this->db->get('t_park')->result();
	}

	// 提交删除的车位
	public function post_del_car($carid){
		// $this->db->where('id',$carid);
		$this->db->delete('t_park',array('id' => $carid));
		return $this->db->affected_rows();
	}

	// 提交新增的车位
	public function post_save_car($carno,$carstatus){
		$data = array(
			'number' => $carno,
			'status' => $carstatus
		);
		$this->db->insert('t_park',$data);
		return $this->db->affected_rows();
	}

	// 获取离开车位的信息
	public function get_carsout(){
		$this->db->select('*');
		$this->db->from('t_user user');
		$this->db->join('t_park park', 'park.owner=user.user_id');
		return $this->db->get()->result();
	}

	// 提交离开车位的信息
	public function post_out_car($carid,$statusout){
		$arr = array(
				'status' => $statusout
			);
		$this->db->where('id', $carid);
		$this->db->update('t_park', $arr);
		return $row = $this->db->affected_rows();
	}

	// 提交没有预定车位的信息
	public function post_noreserve($positionid,$status,$owner){
		$arr = array(
				'id' => $positionid,
				'status' => $status,
				'owner' => null
				// 'carout' => $outtime
			);
		$this->db->where('id',$positionid);
		$this->db->update('t_park', $arr);

		$data = array(
			'user_id' => $owner,
			'money' => '10'
		);
		$this->db->insert('t_money',$data);

		// $data2 = array(
  //           'user_id' => $owner,
  //       );
  //       return $this->db->get_where('t_record',$data2)->row();

		$data1 = array(
				'user_id' => $owner,
				// 'money' => 
				// 'carout' => $outtime
			);
		$this->db->where('id',$positionid);
		$this->db->update('t_park', $arr);

		// $da = array(
		// 	'user_id' => $owner,
		// 	'record' => '10'
		// );
		// $this->db->insert('t_record',$da);



        // $this->db->delete('t_park');
        return $row = $this->db->affected_rows();

	}

}