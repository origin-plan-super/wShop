<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月28日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####需要登录权限的继承本控制器#####
* @author 代码狮
*
*/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    
    //ThinkPHP提供的构造方法
    public function _initialize() {
        
        
        
        session('openid',null);
        if (empty(session('openid'))) {
            
            
            
            $url=U('common/_initialize');
            
            $info= baseAuth($url);
            $openid= $info['openid'];
            $access_token= $info['access_token'];
            session('openid',$openid);
            session('access_token',$access_token);
            
            F('user',$info);
            
            
            // $url=U('Index/index');
            // echo "<script>top.location.href='$url'</script>";
            // exit ;
        }else{
            
            $user_id = session('openid');
            session('user_id', $user_id);
            
        }
        
    }
    
}