<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<title>新地址</title>
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/mui/css/mui.min.css" />
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


		<header id="header" class="mui-bar mui-bar-nav">

			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left a-font-black"></a>
			<h1 class="mui-title a-font-white">导航栏</h1>

			<input type='submit' class="mui-pull-right add-save a-font-white">保存</input>

		</header>
		<div class="mui-collapse-content">
			<div class="mui-input-group">
				<div class="mui-input-row">
					<label>收货人</label>
					<input type="text" class="mui-input-clear" name="people">
				</div>
				<div class="mui-input-row">
					<label>联系电话</label>
					<input type="text" class="mui-input-clear" name="tel">
				</div>
				<div class="mui-input-row">
					<label>所在地区</label>
					<input type="text" class="address" id="cityPicker" placeholder="请选择省市区县" style="font-size:10px;">
				</div>
				<div class="mui-input-row">
					<label>街道</label>
					<input type="text" class="mui-input-clear" name="">
				</div>
				<div class="mui-input-row" id="detailed">
					<textarea id="info" rows="5" placeholder="详细地址" class="address2"></textarea>
				</div>
	</form>
	</div>
	</form>

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