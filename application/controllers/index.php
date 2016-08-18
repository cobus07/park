<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// 首页控制器
class Index extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
    }
    // 跳转到停车场首页
    public function park(){
        // 下面这行代码的意思是页面跳转的意思
    	$this->load->view("park");
    }

    // 跳转到停车场介绍页面
    public function jieshao(){
    	$this->load->view("jieshao");
    }

    // 跳转到停车场收费介绍页面
    public function shoufei(){
    	// $this->load->view("shoufei");
        $this->load->model('sta_model');

        $results = $this->sta_model->searchall();
        // var_dump($result);
        // die();
        $data = array(
                'result' => $results
            );
        $this->load->view('shoufei',$data);
    }

    // 停车场帮助页面
    public function help(){
    	$this->load->view("help");
    }

    // 向用户注册登录页面跳转
    public function usernologin(){
    	$this->load->view("userweidonglu");
    }

    // 向管理员注册登录页面跳转
    public function adminnologin(){
    	$this->load->view("adminnologin");
    }
}