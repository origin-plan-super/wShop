<?php
/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月28日
* 最新修改时间：2017年11月28日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* 微信：AJS0314
* +----------------------------------------------------------------------
* QQ:1173197065
* +----------------------------------------------------------------------
* #####品牌控制器#####
* @author 代码狮
*
*/
namespace Admin\Controller;
use Think\Controller;
class OrderController extends Controller{
    
    //构造函数
    public function _initialize(){
        
    }
    //主
    public function index(){
        
    }
    //空操作
    public function _empty(){
        
    }
    
    /**
    * 获得
    */
    public function getList(){
        
        $get = I('get.');
        $table = strtolower($get['table']);
        //创建模型
        $model = M($table);
        
        //定制分页-start
        $page=$get['page'];
        $limit=$get['limit'];
        $page=($page-1)* $limit;
        //定制分页-end
        
        if(!empty($get['key'])){
            
            $key=$get['key'];
            
            $key_where= $get['key_where'] ? $get['key_where']: $table.'_id';
            
            $where[$key_where] = listay(
            'like',
            "%".$key."%",
            'OR'
            );
            
            $result= $model->limit("$page,$limit")->order('add_time desc')->where($where)->select();
            // $res['sql']=$model->_sql();
            $res['count']=$model->where($where)->count();
            
        }else{
            
            $count= $model->count();
            $res['count']=$count;
            $result= $model->limit("$page,$limit")->order('add_time desc')->select();
            $res['sql']=$model->_sql();
            
        }
        
        //转换时间戳
        $result=   toTime($result);
        
        foreach ($result as $key => $value) {
            
            //找用户
            $model=M('user');
            $where=[];
            $where['openid']=$value['openid'];
            $r=$model->where()->find();
            $result[$key]['user_name']=$r['user_name'];
            
            
        }
        
        
        if($result){
            $res['res']= $res['count'];
            $res['code']=1;
            $res['data']= $result;
            $res['msg']= $result;
        }else{
            $res['code']=-1;
            $res['msg']='没有数据！';
        }
        echo json_encode($res);
        
    }
    
    public function show(){
        
        $order_id=I('get.order_id');
        
        $model=M('orderInfo');
        $where=[];
        $where['order_id']=$order_id;
        $orderInfo=$model
        ->field('t1.*,t2.*,t1.info as t1_info')
        ->table('wshop_order_info as t1,wshop_goods as t2')
        ->where('t1.goods_id = t2.goods_id')
        ->where($where)
        ->select();
        
        
        $this->assign('orderInfo',$orderInfo);
        
        
        
        $model=M('order');
        $where=[];
        $where['order_id']=$order_id;
        $order=$model
        ->field('t1.*,t2.*,t3.*')
        ->table('wshop_order as t1,wshop_user as t2,wshop_address as t3')
        ->where('t1.openid = t2.openid AND t1.address_id = t3.address_id')
        ->where($where)
        ->find();
        $this->assign('order',$order);
        
        
        
        $this->display();
        
        // dump($orderInfo);
        // dump($order);
        
        
        
        
        
    }
    
    public function showList(){
        $this->display();
    }
}