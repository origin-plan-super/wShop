<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    
    public function saveField(){
        
        if(IS_POST){
            
            $info = I('post.');
            $id = $info['id'];
            
            if(!empty($id)){
                
                $tableName =   strtolower($info['tableName']);
                $save = $info['save'];
                
                
                
                $model = M($tableName);
                $where[$tableName.'_id'] = $id;
                
                $result =   $model->where($where)->save($save);
                
                
                if($result!== false){
                    $res['res'] = 1;
                    $res['msg'] = $result;
                }else{
                    $res['res'] = -1;
                    $res['msg'] = $result.'【'.$id.'】【'.json_encode($save).'】【'.$tableName.'】';
                }
            }else{
                $res['res'] = -2;
                $res['msg'] = $tableName.'_id is null id:'.$id;
            }
            
        }else{
            $res['res'] = -2;
            $res['msg'] = 'is no post';
        }
        
        echo json_encode($res);
        
        
        
    }
    /*
    查一条
    */
    public function getOne(){
        
        
        $info = I('get.');
        $tableName =   strtolower($info['tableName']);
        $id = $info['id'];
        
        
        if(!empty($id)){
            $model = M($tableName);
            $where[$tableName.'_id'] = $id;
            
            $result =   $model->field($info['field'])->where($where)->find();
            
            
            
            if($result!== false){
                $res['res'] = 1;
                if(empty($info['field'])){
                    $res['msg'] = $result;
                }else{
                    $res['msg'] = $result;
                }
            }else{
                $res['res'] = -1;
                $res['msg'] = 'no';
            }
        }else{
            $res['res'] = -2;
            $res['msg'] = 'id is null id:'.$id;
        }
        
        
        
        echo json_encode($res);
        
        
    }
    /**
    * 通用查表，查所有
    */
    public function getList(){
        
        
        if(!empty(I('get.'))){
            //有get
            $get = I('get.');
            $tableName =   strtolower($get['tableName']);
            $model = M($tableName);
            
            $result  =  $model->select();
            if($result!== false){
                //查询没有出错
                $res['res'] = count($result);
                $res['msg'] = $result;
                
            }else{
                //查询失败
                $res['res'] = $result;
                $res['msg'] = $result;
            }
            
            
        }else{
            //没有任何get
            $res['res'] = -1;
            $res['msg'] = 'no data';
        }
        
        echo json_encode($res);
        
    }
    
    public function add(){
        
        if(!empty(I('post.'))){
            //有get
            $post = I('post.');
            $tableName =   strtolower($post['tableName']);
            
            $add = $post['add'];
            
            $add['add_time']=time();
            $add['edit_time']=time();
            
            $add[$tableName.'_id']=md5($tableName.$add['add_time'].__KEY__.rand());
            
            
            $model = M($tableName);
            
            $result  =  $model->add($add);
            
            if($result!== false){
                //添加没有出错
                $res['res'] = $result;
                $res['msg'] = $add[$tableName.'_id'];
                
            }else{
                //添加失败
                $res['res'] = $result;
                $res['msg'] = $result;
            }
        }else{
            //没有任何post
            $res['res'] = -1;
            $res['msg'] = 'no data';
        }
        
        echo json_encode($res);
        
    }
    
    public function del(){
        
        if(!empty(I('post.'))){
            $post = I('post.');
            $tableName = strtolower($post['tableName']);
            
            $where[$tableName.'_id']= $post['id'];
            
            $model = M($tableName);
            
            $result=$model->where($where)->delete();
            
            if($result){
                //没有出错
                $res['res'] = $result;
                $res['msg'] = $result;
                
            }else{
                //失败
                $res['res'] = $result;
                $res['msg'] = $result;
            }
            
            
        }else{
            //没有post
            $res['res'] = -1;
            $res['msg'] = 'no data';
        }
        echo json_encode($res);
        
        
    }
    /*
    删除选中
    */
    public function delAll(){
        
        
        if(!empty(I('post.'))){
            $post = I('post.');
            $tableName = strtolower($post['tableName']);
            
            
            $id= $post['id'];//这个id必须是数组
            
            $id= implode("','",$id);//用逗号分隔
            
            $where = $tableName."_id in('".$id."')";
            
            
            $model = M($tableName);
            
            $result=$model->where($where)->delete();
            $res['sql'] = $model->_sql();
            
            if($result){
                //没有出错
                $res['res'] = $result;
                $res['msg'] = $result;
                
            }else{
                //失败
                $res['res'] = $result;
                $res['msg'] = $result;
            }
            
            
        }else{
            //没有post
            $res['res'] = -1;
            $res['msg'] = 'no data';
        }
        echo json_encode($res);
        
        
    }
    
    
    
    public function test(){
        
        
        
        
        
    }
    
}



?>
  <?php




?>