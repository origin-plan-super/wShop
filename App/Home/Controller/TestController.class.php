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
* #####购物车控制器#####
* @author 代码狮
*/
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller{
    
    public function test(){
        
        dump(F('user'));
        $head='http://120.78.162.200:12138';
        $url=$head.U('Index/Index');
        dump($url);
        
    }
    
    public function aaa(){
    }
    
    
    
}