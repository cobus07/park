<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 管理员表model
class Admin_model extends CI_Model{

    // 核验管理员的用户名和密码
	public function get_by_name_pwd($adminname, $password){
        $arr = array(
            'adminname' => $adminname,
            'password' => $password
        );
        return $this->db->get_where('t_admin', $arr)->row();
    }

    // 更新管理员个人信息
    public function update_admin($adminid, $adminname, $password, $admintel){
        $arr = array(
                "adminname" => $adminname,
                "password" => $password,
                "tel" => $admintel
            );
        $this->db->where('admin_id',$adminid);
        $this->db->update('t_admin',$arr);
        return $row = $this->db->affected_rows();
    }
}