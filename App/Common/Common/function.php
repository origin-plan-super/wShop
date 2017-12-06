<?php

/**
* 将时间戳转换为能看的懂的
* 传入数组型
*/
function toTime($arr){
    
    
    foreach ($arr as $key => $value) {
        
        if(!empty($value['add_time'])){
            $arr[$key]['add_time']=date('Y-m-d H:i:s',$value['add_time']);
        }
        if(!empty($value['edit_time'])){
            $arr[$key]['edit_time']=date('Y-m-d H:i:s',$value['edit_time']);
        }
    }
    
    return $arr;
    
}