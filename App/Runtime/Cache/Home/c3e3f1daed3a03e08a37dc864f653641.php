<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<title>新地址</title>
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/mui/css/mui.min.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />

	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/jquery/jquery-weui.min.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/addAddress/css/addAddress.css" />
	<style>
		#header {
			background-color: #000000;
			color: #ffffff;
		}

		#header * {
			background-color: #000000;
			border: none;
			color: #ffffff;

		}

		.a-font-white.add-save {
			line-height: 2;
		}
	</style>
</head>

<body>

	<form action="" method="post">


		<div class="mui-collapse-content">
			<div class="mui-input-group">
				<div class="mui-input-row">
					<label>收货人</label>
					<input type="text" class="mui-input-clear" name="people">
				</div>
				<div class="mui-input-row">
					<label>联系电话</label>
					<input type="text" class="mui-input-clear" name="phone">
				</div>
				<div class="mui-input-row">
					<label>所在地区</label>
					<input type="text" class="address" id="cityPicker" name="location[l1]" placeholder="请选择省市区县" style="font-size:10px;">
				</div>
				<div class="mui-input-row">
					<label>街道</label>
					<input type="text" class="mui-input-clear" name="location[l2]">
				</div>
				<div class="mui-input-row" id="detailed">
					<textarea id="info" rows="5" placeholder="详细地址" class="address2" name="location[l3]"></textarea>
				</div>
			</div>
		</div>
	</form>

	<a href="/wShop/index.php/Home/query/query" class="query">
    <i class="iconfont icon-fangdajing"></i>
</a>

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

	<script src="/wShop/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/mui/js/mui.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/mui/js/mui.pullToRefresh.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/mui/js/mui.pullToRefresh.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/jquery/jquery-weui.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/jquery/city-picker.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/a/a.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/addAddress/js/addAddress.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$("#cityPicker").cityPicker({
			title: "选择省市区/县",
			onChange: function (picker, values, displayValues) {
				console.log(values, displayValues);
			}
		});
		isNav("#header");
	</script>
</body>

</html>