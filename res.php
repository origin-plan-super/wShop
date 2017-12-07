<?php
$APPID='wxc5919bd34da8b695';  //填写高级调用功能的app id
$appsecret='87e678bca54b92f8c7213e1ba9f12963';  //填写高级调用功能的密钥

$code = $_GET["code"];
//$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$APPID.'&secret='.$APPSECRET.'&code='.$code.'&grant_type=authorization_code';
$get_token_url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$APPID&secret=$APPSECRET";
$res = post($get_token_url);
$json_obj = json_decode($res,true);

//根据openid和access_token查询用户信息
$access_token = $json_obj['access_token'];

$get_openid_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$APPID.'&secret='.$APPSECRET.'&code='.$code.'&grant_type=authorization_code';
$res = post($get_openid_url);
$json_obj = json_decode($res,true);
$openid = $json_obj['openid'];

$get_user_base_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
$res = post($get_user_base_info_url);


/*
$get_userinfo_url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
$res = post($get_userinfo_url);

//解析json
$user_obj = json_decode($res,true);
$_SESSION['user'] = $user_obj;
print_r($user_obj);
echo "<br/>";
*/

function post($url){
    echo "url: $url <br/>";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HEADER,0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $res = curl_exec($ch);
    curl_close($ch);
    echo "resp: $res <br/><br/>";
    return $res;
}
?>