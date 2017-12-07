<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>个人中心</title>
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/user/css/user.css" />
	<style>
		a {
			text-decoration: none;
			color: #333;
		}

		a:focus,
		a:hover {
			color: #333;
			text-decoration: none;

		}
	</style>

</head>

<body>
	<!--顶部导航栏开始-->

	<!--顶部导航栏结束-->

	<!--全局的div id为user_page  内容开始-->
	<div id="user_page">
		<!--用户的头像和名字部分-->
		<div class="user-head">
			<img src="" / id="user_head">
			<span id="user_name" class="user-name"></span>
		</div>
		<!--个人中心下边的列表-->
		<ul class="a-list list-lg">
			<a href="/wShop/index.php/Home/Order/showList">
				<li>
					<span class="">我的订单</span>
					<span class="iconfont icon-mjiantou-copy1 fr"></span>
				</li>
			</a>
			<a href="/wShop/index.php/Home/Address/showList">
				<li>
					<span class="">收货地址管理</span>
					<span class="iconfont icon-mjiantou-copy1 fr"></span>
				</li>
			</a>
			<a href="/wShop/index.php/Home/Index/About">
				<li>
					<span class="">关于我们</span>
					<span class="fr">
						<span class="iconfont icon-mjiantou-copy1"></span>
					</span>
				</li>
			</a>
			<a href="#">
				<li>
					<span class="">服务热线</span>
					<span class="fr">65581111154</span>
				</li>
			</a>
		</ul>
	</div>
	<!--全局的div id为user_page  内容开始-->

	<!--底部导航栏开始-->

	<?php if([ss] != 3): ?><a href="/wShop/index.php/Home/query/query" class="query">
        <i class="iconfont icon-fangdajing"></i>
    </a><?php endif; ?>


<!--底部导航栏开始-->
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default" id="" style="">
    <ul class="am-navbar-nav am-cf am-avg-sm-4 a-black">
        <li>
            <a href="/wShop/index.php/Home/Index/index" class="">
                <span class="iconfont icon-fangzicopy"></span>
            </a>
        </li>
        <li>
            <a href="/wShop/index.php/Home/Brand/brand" class=" ">
                <span class="iconfont icon-pinpai1 "></span>
            </a>
        </li>
        <li>
            <a href="/wShop/index.php/Home/ShopBag/shopBag" class=" ">
                <span class="iconfont icon-gouwuche "></span>
            </a>
        </li>
        <li>
            <a href="/wShop/index.php/Home/User/user" class=" ">
                <span class="iconfont icon-gerenzhongxin "></span>
            </a>
        </li>
    </ul>
</div>
<!--底部导航栏结束-->

	<!--底部导航栏结束-->
	<script src="/wShop/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/a/a.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/user/js/user.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		//			isNav(".am-header");


		var user_info = JSON.parse('<?php echo ($user_info); ?>');

		// w(user_info);
		// headimgurl
		$('#user_name').text(user_info.nickname);
		$('#user_head').attr('src', user_info.headimgurl);

		// getUserInfo('<?php echo ($openid); ?>', '<?php echo ($access_token); ?>');

		function getUserInfo(openid, access_token) {

			$.get('https://api.weixin.qq.com/sns/userinfo?access_token=' + access_token + '&openid=' + openid + '&lang=zh_CN ', function (res) {

				try {
					res = JSON.parse(res);
				} catch (error) {
					//转换错误
				}

				console.warn(res.headimgurl);

			});

		}

	</script>
</body>