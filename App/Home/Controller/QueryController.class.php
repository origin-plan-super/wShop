<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年12月6日
* 最新修改时间：2017年12月6日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####商品详情控制器#####
* @author 代码狮
*/
namespace Home\Controller;
use Think\Controller;
class QueryController extends Controller{
    
    //构造函数
    public function _initialize(){
        
    }
    //主
    public function query(){
        
        if(IS_POST){
            $post=I('post.');
            
            
            $key= preg_replace("/[\s]+/is","%",$post['key']);
            
            
            $model=M('goods');
            $where=[];
            $where['goods_title'] = array(
            'like',
            "%".$key."%",
            'OR'
            );
            
            $where['is_show']=1;
            
            $goods=$model->where($where)->select();
            
            
            $this->assign('goods',$goods);
            
        }
        
        $this->display();
        
        
        
        
        
    }
    
    //空操作
    public function _empty(){
        
    }
    
    
}