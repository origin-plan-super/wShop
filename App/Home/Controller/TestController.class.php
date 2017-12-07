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
        
        $code=I('get.code');
        $nsukey=I('get.nsukey');
        
        // $ip='192.168.1.196:12138';
        $ip='127.0.0.1:12138';
        
        
        echo "<script>window.location.href='http://$ip/wShop/index.php/home/test/test2/code/$code/nsukey/$nsukey'</script>";
        
    }
    public function test2(){
        
        $code=I('get.code');
        $nsukey=I('get.nsukey');
        
        echo '<h1><a href="http://127.0.0.1:12138/wShop/test.html">回去</a></h1>';
        $url= "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx9b7ab18e61268efb&secret=bcd46807674b9448617438256db6cada&code=$code&grant_type=authorization_code";
        $this->assign('url',$url);
        
        $this->display();
    }
    
}