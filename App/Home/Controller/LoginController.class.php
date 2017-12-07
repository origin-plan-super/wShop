<?php

namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller{
    
    //构造函数
    public function _initialize(){
        
    }
    public function login(){
        
        $openid= I('post.openid');
        $access_token= I('post.access_token');
        session('openid',$openid);
        session('access_token',$access_token);
        
        //=========添加数据=========
        $model=M('user');
        //=========添加数据区
        $add=[];
        $add['openid']=$openid;
        $add['access_token']=$access_token;
        $add['add_time']=time();
        $add['edit_time']=time();
        //=========sql区
        $result=$model->add($add,null,true);
    }
    
    public function openid(){
        
        
        $code=I('get.code');
        $nsukey=I('get.nsukey');
        // $ip='192.168.1.196:12138';
        // $ip='127.0.0.1:12138';
        $ip='120.78.162.200:12138';
        echo "<script>window.location.href='http://$ip/wShop/index.php/home/login/setOpenid/code/$code/nsukey/$nsukey'</script>";
        
        
    }
    
    public function setOpenid(){
        
        $code=I('get.code');
        $nsukey=I('get.nsukey');
        $ip='127.0.0.1:12138';
        echo "<h1><a href='http://$ip/wShop/test.html'>回去</a></h1>";
        $url= "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx9b7ab18e61268efb&secret=bcd46807674b9448617438256db6cada&code=$code&grant_type=authorization_code";
        $this->assign('url',$url);
        $this->display();
        
    }
    
    
    //空操作
    public function _empty(){
        
    }
    
}