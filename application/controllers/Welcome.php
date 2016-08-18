<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// 用户控制器
class Welcome extends CI_Controller {
    // 连接数据库 model
	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('park_model');
    }
    // 跳转主页
    public function goindex(){
        $this->load->view('park');
    }

    // 用户注册
    public function zhuce(){
        $this->load->view("zhuce");
    }

    // 默认跳转方法 index
	public function index()
	{
		$this->load->view('login');
	}

    // 管理员登录 跳转
	public function admin_login(){
		$this->load->view('admin/login');
	}

    //  登陆成功 跳转到用户首页 并将汽车的状态从数据库查询出来 默认在用户主页面显示
    public function login_success(){
        $cars = $this->park_model->searchall();
        $data = array(
                'cars' => $cars
            );
        $this->load->view('userindex',$data);
    }

    // 用户注销 将session删除
    public function logout(){
        // $this->session->unset_userdate('login_user');
        unset($_SESSION['login_user']);
        redirect('Welcome/index');
    }

    // 用户注册 存储用户信息
	public function save_user(){
        // 接收数据
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));
        $usercar = htmlspecialchars($this->input->post('car'));
        $usertel = htmlspecialchars($this->input->post('tel'));
        // 访问数据库
        if($username == "" || $password == "" || $usercar == "" || $usertel ==""){
            echo "<script>alert('注册信息不完善，注册失败！')</script>";
            // redirect('Welcome/zhuce');
            $this->load->view('zhuce');
        }else{
            $this->user_model->save($username, $password,$usercar,$usertel);
            // 跳转页面
            $this->load->view('registsu');
        }
        
    }

    // 检查 该用户 是否已注册
    public function check_username(){
        $name = $this->input->get('name');
        $row = $this->user_model->check_name($name);
        if($row){
            echo 'fail';
        }else{
            echo 'success';
        }
    }

    // 用户登录
    public function check_login(){
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));

        $row = $this->user_model->get_by_name_pwd($username, $password);

        if($row){
//            登陆成功，向session存入用户数据
            $this->session->set_userdata('login_user', $row);
//            $this->load->view('admin/admin-index');
            redirect('Welcome/login_success');
        }else{
            $this->index();
        }
    }

    // 用户信息 更新
    public function update_user(){
        $userid = htmlspecialchars($this->input->post('userid'));
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));
        $usercar = htmlspecialchars($this->input->post('car'));
        $usertel = htmlspecialchars($this->input->post('tel'));

        $row = $this->user_model->update_user($userid,$username, $password,$usercar,$usertel);
        if($row>0){
            echo "<script>alert('修改成功！');location.href='../Welcome/login_success';</script>";
        }else{
            echo "<script>alert('修改失败！');location.href='../Welcome/login_success';</script>";
        }
    }

    // AJAX技术 获取 停车场车位状态
    public function ajax_get_reserve(){
        $status_b = $this->input->get('statusb');
        $status_w = $this->input->get('statusw');
        $result_b = $this->park_model->ajax_get_reserve_b($status_b);
        $result_w = $this->park_model->ajax_get_reserve_w($status_w);
        $json = array(
                'data_b' => $result_b,
                'data_w' => $result_w
        );
        echo json_encode($json);
    }

    // 提交车位预定信息
    public function post_reserve(){
        $reserve_id = $this->input->post('reserve_id');
        $user_id = $this->input->post('user_id');
        // $intime = $this->input->post('intime');
        $row = $this->park_model->post_reserve($reserve_id,$user_id);
        if($row>0){
            echo "success";
        }else{
            echo "fail";
        }
    }

    // 获取该用户预定的车位
    public function get_reserve(){
        $userid = $this->input->get('userid');
        $result = $this->park_model->get_reserve($userid);
        $json = array(
                'myposition' => $result
            );
        echo json_encode($json);
    }

    // 车位离开
    public function post_noreserve(){
        $positionid = $this->input->post('positionid');
        $status = $this->input->post('status');
        // $outtime = $this->input->post('outtime');
        $owner = $this->input->post('owner');
        $row = $this->park_model->post_noreserve($positionid,$status,$owner);
        // $row2 = $this->money_model->post_noreserve($owner);
        
        if($row != -1){
            echo "success";
        }else{
            echo "fail";
        }

    }

    // 获取用户的消费记录
    public function get_money(){
        $userid = $this->input->get('userid');
        $result = $this->park_model->get_money($userid);
        $json = array(
                'mymoney' => $result
            );
        echo json_encode($json);
    }

    // 获取用户的积分记录
    public function get_record(){
        $userid = $this->input->get('userid');
        $result = $this->park_model->get_record($userid);
        $json = array(
                'myrecord' => $result
            );
        echo json_encode($json);
    }

    // 用户升级为VIP
    public function go_vip(){
        $userid = $this->input->post('userid');
        $uservip = $this->input->post('uservip');
        $row = $this->user_model->post_govip($userid,$uservip);
        if($row>0){
            echo "success";
        }else{
            echo "fail";
        }
    }

    // 用户费用充值
    public function chongzhi(){
        $userid = $this->input->post('userid');
        $usermoney = $this->input->post('money');
        $row = $this->user_model->chongzhi($userid,$usermoney);
        if($row>0){
            echo "<script>alert('充值成功！');location.href='../Welcome/login_success';</script>";
        }else{
            echo "<script>alert('充值失败！');location.href='../Welcome/login_success';</script>";
        }
    }


    // 通过用户user_id查询用户的余额
    public function chaxun(){
        $userid = $this->input->post('userid');
        $row = $this->user_model->get_yue($userid);
        $json = array(
                'user' => $row
            );
        echo json_encode($json);
    }

}

