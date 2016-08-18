<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 用户model
class User_model extends CI_Model{

    // 用户个人信息存储
	public function save($username,$password,$usercar,$usertel){

        $arr = array(
            "username" => $username,
            "password" => $password,
            "carno" => $usercar,
            "tel" => $usertel
            );
    	$this->db->insert('t_user',$arr);
    }

    // 核验 该用户存不存在
    public function check_name($name){
            $query = $this->db->get_where('t_user',array('username'=>$name));
            return $query->row();
    }

    // 获取与该用户名 密码 匹配的用户信息
    public function get_by_name_pwd($username, $password){
        $arr = array(
            'username' => $username,
            'password' => $password
        );
        // 返回一条用户信息
        return $this->db->get_where('t_user', $arr)->row();
    }

    // 更新用户个人信息
    public function update_user($userid,$username,$password,$usercar,$usertel){
        $arr = array(
                "username" => $username,
                "password" => $password,
                "carno" => $usercar,
                "tel" => $usertel
            );
        $this->db->where('user_id',$userid);
        $this->db->update('t_user',$arr);
        return $row = $this->db->affected_rows();
    }

    // 获取所有的用户信息
    public function get_all_user(){
        // 返回一个结果集
        return $this->db->get('t_user')->result();
    }

    // 将用户的会员状态改为VIP
    public function get_vip(){
        return $this->db->get('t_user')->result();
    }

    // 将用户的会员状态改为非VIP
    public function post_delvip($userid,$uservip){
        $arr = array(
                'vip' => $uservip
            );
        $this->db->where('user_id', $userid);
        $this->db->update('t_user',$arr);
        return $row = $this->db->affected_rows();
    }

    public function post_govip($userid,$uservip){
        $arr = array(
                'vip' => $uservip
            );
        $this->db->where('user_id', $userid);
        $this->db->update('t_user',$arr);
        return $row = $this->db->affected_rows();
    }

    // 提交删除的用户
    public function post_deluser($userid){
        $this->db->where('user_id',$userid);
        $this->db->delete('t_user');
        return $row = $this->db->affected_rows();
    }

    // 管理用户
    public function adminuser($userid){
        $arr = array(
            'user_id' => $userid,
        );
        return $this->db->get_where('t_user',$arr)->row();
    }

    // 编辑用户信息
    public function bianjiuser($userid,$username,$password,$carno,$tel,$vip){
        $arr = array(
            'username' => $username,
            'password' => $password,
            'carno' => $carno,
            'tel' => $tel,
            'vip' => $vip
        );
        $this->db->where('user_id',$userid);
        $this->db->update('t_user',$arr);
        return $row = $this->db->affected_rows();
    }

    // 用户充值
    public function chongzhi($userid,$usermoney){

        $oldmoney =  $this->db->get_where('t_user', array('user_id' => $userid))->row();

        $newmoney = $usermoney + $oldmoney->money;
        $arr = array(
            'money' => $newmoney
        );
        $this->db->where('user_id',$userid);
        $this->db->update('t_user',$arr);
        return $row = $this->db->affected_rows();
    }

    // 用户的余额查询
    public function get_yue($userid){
        $arr = array(
            'user_id' => $userid,
        );
        return $this->db->get_where('t_user',$arr)->row();
    }

    // 获取用户的费用充值信息
    public function get_chongzhi(){
        return $this->db->get('t_user')->result();
    }
}
