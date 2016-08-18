<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// 文章详情控制器 
class Article extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
    }
    // 跳转到首页动态页面
    public function dongtai(){
    	$this->load->view("article");
    }
}