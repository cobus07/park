<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// 管理员控制器 负责 业务逻辑 跳转
class Admin extends CI_Controller {
    // 链接数据库
	public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('park_model');
        $this->load->model('user_model');
        $this->load->model('money_model');
        $this->load->model('record_model');
        $this->load->model('sta_model');
    }

    // 跳转主页
    public function goindex(){
        $this->load->view('park');
    }

    // 管理员登陆
	public function login(){
		$this->load->view('admin/login');
	}

    // 登陆成功页面跳转
    public function login_success(){
        $cars = $this->park_model->searchall();
        $data = array(
                'cars' => $cars
            );
        $this->load->view('adminindex',$data);
    }

    // 检测管理员登陆信息
    public function admin_check_login(){
        $adminname = htmlspecialchars($this->input->post('adminname'));
        $password = htmlspecialchars($this->input->post('password'));

        $row = $this->admin_model->get_by_name_pwd($adminname, $password);

        if($row){
//            登陆成功，向session存入用户数据
            $this->session->set_userdata('login_admin', $row);
//            $this->load->view('admin/admin-index');
            redirect('admin/login_success');
        }else{
            $this->login();
        }
    }

    // 更新管理员个人信息
    public function update_admin(){
        $adminid = htmlspecialchars($this->input->post('adminid'));
        $adminname = htmlspecialchars($this->input->post('adminname'));
        $password = htmlspecialchars($this->input->post('password'));
        $admintel = htmlspecialchars($this->input->post('tel'));

        $row = $this->admin_model->update_admin($adminid, $adminname, $password, $admintel);
        if($row>0){
            // 修改成功 跳转页面
            echo "<script>alert('修改成功！');location.href='../admin/login_success';</script>";
        }else{
            // 修改失败 跳转页面
            echo "<script>alert('修改失败！');location.href='../admin/login_success';</script>";
        }
    }

    // 管理员注销 session 删除
    public function logout(){
        unset($_SESSION['login_admin']);
        redirect('admin/login');
    }

    // AJAX方式 获取数据 动态的插入到页面中
    // 停车场的车位信息
    public function ajax_admincar(){
        $result = $this->park_model->get_cars();
        $json = array(
                'cars' => $result
            );
        // 将获取的数据转化为json格式
        echo json_encode($json);
    }

    // 删除车位
    public function post_del_car(){
        $carid = $this->input->post('car_id');
        $row = $this->park_model->post_del_car($carid);
        if($row != -1){
            echo "success";
        }else{
            echo "fail";
        }
    }

    // 增添车位
    public function post_save_car(){
        $carno = $this->input->post('carno');
        $carstatus = $this->input->post('carstatus');
        if($carstatus == '已占'){
            $carstatus = 'black';
        }else{
            $carstatus = 'white';
        }
        $row = $this->park_model->post_save_car($carno,$carstatus);
        if($row > 0){
            echo "<script>alert('保存成功!');location.href='../admin/login_success'</script>";
        }else{
            echo "<script>alert('保存不成功！')</script>";
        }
    }

    // AJAX获取 车位状态
    public function ajax_carout(){
        $result = $this->park_model->get_carsout();
        $json = array(
                'cars' => $result
            );
        echo json_encode($json);
    }

    // 提交 离开的车位 信息
    public function post_out_car(){
        $carid = $this->input->post('id');
        $statusout = $this->input->post('statusout');
        $row = $this->park_model->post_out_car($carid, $statusout);
        if($row>0){
            echo "success";
        }else{
            echo "fail";
        }
    }

    // 获取所有用户的信息
    public function get_user(){
        $result = $this->user_model->get_all_user();
        $json = array(
                'users' => $result
            );
        echo json_encode($json);
    }

    // 获取用户消费记录
    public function get_money(){
        $result = $this->money_model->get_money();
        $json = array(
                'usermoney' => $result
            );
        echo json_encode($json);
    }

    // 获取用户积分记录
    public function get_record(){
        $result = $this->record_model->get_record();
        $json = array(
                'userrecord' => $result
            );
        echo json_encode($json);
    }

    // 获取用户的会员非会员状态
    public function get_vip(){
        $result = $this->user_model->get_vip();
        $json = array(
                'uservip' => $result
            );
        echo json_encode($json);
    }

    // 将用户降级为非会员
    public function post_delvip(){
        $userid = $this->input->post('userid');
        $uservip = $this->input->post('uservip');
        $row = $this->user_model->post_delvip($userid,$uservip);
        if($row>0){
            echo "success";
        }else{
            echo "fail";
        }
    }

    // 将用户升级为会员
    public function post_govip(){
        $userid = $this->input->post('userid');
        $uservip = $this->input->post('uservip');
        $row = $this->user_model->post_govip($userid,$uservip);
        if($row>0){
            echo "success";
        }else{
            echo "fail";
        }
    }

    // 提交删除用户 
    public function post_deluser(){
        $userid = $this->input->post('userid');
        $row = $this->user_model->post_deluser($userid);
        // 返回成功与失败
        if($row != -1){
            echo "success";
        }else{
            echo "fail";
        }

    }

    // 管理用户个人信息
    public function adminuser(){
        $userid = $this->input->get('userid');
        $row = $this->user_model->adminuser($userid);
        $data = array(
                'user' => $row
            );
        $this->load->view('bianji',$data);
    }

    // 将编辑过的用户信息提交
    public function bianjiuser(){
        $userid = $this->input->post('userid');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $carno = $this->input->post('carno');
        $tel = $this->input->post('tel');
        $vip = $this->input->post('vip');
        $row = $this->user_model->bianjiuser($userid,$username,$password,$carno,$tel,$vip);
        if($row>0){
            echo "<script>alert('修改成功')</script>";
            redirect('admin/login_success');
        }else{
            echo "<script>alert('修改失败')</script>";
        }
    }

    // 编辑用户积分
    public function bianjirecord(){
        $userid = $this->input->get('userid');
        $result = $this->record_model->bianjirecord($userid);
        $data = array(
                'records' => $result
            );
        $this->load->view('record',$data);
    }

    // 管理用户积分
    public function adminrecord(){
        $userid = $this->input->post('userid');
        $record = $this->input->post('record');
        $addtime = $this->input->post('addtime');
        $row = $this->record_model->adminrecord($userid,$record,$addtime);
        if($row>0){
            echo "<script>alert('修改成功')</script>";
            redirect('admin/login_success');
        }else{
            echo "<script>alert('修改失败')</script>";
        }
    }

    // 费用充值
    public function chongzhi(){
        $result = $this->user_model->get_chongzhi();
        $json = array(
                'userchongzhi' => $result
            );
        echo json_encode($json);
    }

    // 车费管理
    public function chefeiadmin(){
        $this->load->view('chefeiadmin');
    }

    // 车费编辑
    public function chefeibianji(){
        $cartype = $this->input->post('cartype');
        $cardtype = $this->input->post('cardtype');
        $money = $this->input->post('money');
        $row = $this->sta_model->chefeibianji($cartype, $cardtype, $money);
        if($row>0){
            echo "<script>alert('修改成功')</script>";
            redirect('admin/login_success');
        }else{
            echo "<script>alert('修改失败')</script>";
        }
    }
}