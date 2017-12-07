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

//设置网络请求配置
function _request($curl,$https=true,$method='GET',$data=null){
    // 创建一个新cURL资源
    $ch = curl_init();
    
    // 设置URL和相应的选项
    curl_setopt($ch, CURLOPT_URL, $curl);    //要访问的网站
    curl_setopt($ch, CURLOPT_HEADER, false);    //启用时会将头文件的信息作为数据流输出。
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //将curl_exec()获取的信息以字符串返回，而不是直接输出。
    
    if($https){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  //FALSE 禁止 cURL 验证对等证书（peer's certificate）。
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  //验证主机
    }
    if($method == 'POST'){
        curl_setopt($ch, CURLOPT_POST, true);  //发送 POST 请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  //全部数据使用HTTP协议中的 "POST" 操作来发送。
    }
    
    
    // 抓取URL并把它传递给浏览器
    $content = curl_exec($ch);
    if ($content  === false) {
        return "网络请求出错: " . curl_error($ch);
        exit();
    }
    //关闭cURL资源，并且释放系统资源
    curl_close($ch);
    // http://127.0.0.1:12138/wShop/index.php/home/test/index
    return $content;
}




/**
* 获取用户的openid
* @param  string $openid [description]
* @return [type]         [description]
*/
function baseAuth($redirect_url){
    $appid='wx9b7ab18e61268efb';
    $appsecret='bcd46807674b9448617438256db6cada';
    //1.准备scope为 snsapi_base 网页授权页面 snsapi_userinfo
    $baseurl = urlencode($redirect_url);
    $snsapi_base_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$baseurl.'&response_type=code&scope=snsapi_base&state=YQJ#wechat_redirect';
    
    //2.静默授权,获取code
    //页面跳转至redirect_uri/?code=CODE&state=STATE
    $code = $_GET['code'];
    if( !isset($code) ){
        header('Location:'.$snsapi_base_url);
    }
    
    
    //3.通过code换取网页授权access_token和openid
    $curl = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
    $content =_request($curl);
    $result = json_decode($content,true);
    
    return $result;
}