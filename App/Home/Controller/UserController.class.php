<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年12月5日
* 最新修改时间：2017年12月5日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####用户控制器#####
* @author 代码狮
*/
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
    
    //构造函数
    public function _initialize(){
        
    }
    //主
    public function user(){
        
        
        $this->assign('access_token',$access_token);
        $this->assign('openid',$openid);
        $this->display();
        
    }
    //空操作
    public function _empty(){
        
    }
    
    
}