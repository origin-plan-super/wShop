<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>商品详情</title>
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/prompt/css/prompt.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/goodsInfo/css/goodsInfo.css" />
	<style>
		.am-gotop-fixed .am-gotop-icon {
			width: 100%;
			line-height: 40px;
			vertical-align: middle;
			background-color: rgba(0, 0, 0, 0.8);
			color: #ddd;
			font-size: 20px;
		}

		.am-gotop.am-gotop-fixed.gotop.am-no-layout.am-active[data-am-widget="gotop"] {
			bottom: 80px;
			width: 40px;
		}

		.am-gotop.am-gotop-fixed.gotop.am-no-layout.am-active[data-am-widget="gotop"] a {
			bottom: 80px;
		}
	</style>
</head>

<body>


	<!--商品详情的顶部大图-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 ">
				<div class="p-0 m-0 goods-list " data-am-widget="paragraph" data-am-paragraph="{ tableScrollable: true, pureview: true }">
					<img src="/wShop/<?php echo ($goods["info_head_img"]); ?>" />
					<div class="goods-info">
						<div><?php echo ($goods["goods_title"]); ?></div>
						<div class="a-price">￥<?php echo ($goods["money"]); ?></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 style-box">

				规格参数：
				<div>
					颜色：
					<?php if(is_array($goods["_color"])): $i = 0; $__LIST__ = $goods["_color"];if( count($__LIST__)==0 ) : echo "没有相关参数" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><span class="style-item" data-group='color' data-value='<?php echo ($vol); ?>'>
							<?php echo ($vol); ?>
						</span><?php endforeach; endif; else: echo "没有相关参数" ;endif; ?>
				</div>
				<div>
					大小：
					<?php if(is_array($goods["_size"])): $i = 0; $__LIST__ = $goods["_size"];if( count($__LIST__)==0 ) : echo "没有相关参数" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><span class="style-item" data-group='size' data-value='<?php echo ($vol); ?>'>
							<?php echo ($vol); ?>
						</span><?php endforeach; endif; else: echo "没有相关参数" ;endif; ?>
				</div>
				<div>
					尺码：
					<?php if(is_array($goods["_size2"])): $i = 0; $__LIST__ = $goods["_size2"];if( count($__LIST__)==0 ) : echo "没有相关参数" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><span class="style-item" data-group='size2' data-value='<?php echo ($vol); ?>'>
							<?php echo ($vol); ?>
						</span><?php endforeach; endif; else: echo "没有相关参数" ;endif; ?>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="a-essay goods-info" data-am-widget="paragraph" data-am-paragraph="{ tableScrollable: true, pureview: true }"
				 style="">
					<?php echo (htmlspecialchars_decode($goods["info"])); ?>
				</div>
			</div>
		</div>


	</div>
	<!--底部的购物车-->
	<div class="row info-bottom">
		<a href="/wShop/index.php/Home/ShopBag/shopBag">
			<div class="col-xs-4 info-bottom-3">
				<span class="iconfont icon-gouwuche"></span>
			</div>
		</a>
		<a href="javascript:;" id="toShopBag">
			<div class="col-xs-8 info-bottom-9">
				<span class="">加入购物车</span>
			</div>
		</a>
	</div>

	<div data-am-widget="gotop" class="am-gotop am-gotop-fixed gotop">
		<a href="#top" title="">
			<i class="am-gotop-icon am-icon-arrow-up "></i>
		</a>
	</div>

	<script src="/wShop/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/amazeui/js/amazeui.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/prompt/js/prompt.js" type="text/javascript" charset="utf-8"></script>
	<!--  -->

	<script src="/wShop/Public/Home/dist/a/a.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/goodsInfo/js/goodsInfo.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">



		var info = {
			color: {
				title: '颜色',
				item: ''
			},
			size: {
				title: '大小',
				item: ''
			},
			size2: {
				title: '尺寸',
				item: ''
			},
		};


		(function () {
			//加入购物车
			var eventName = 'touchstart';
			var el = '#toShopBag';
			var fun = function (event) {
				var $this = $(this);
				var goods_id = '<?php echo ($goods["goods_id"]); ?>';
				addBag(goods_id);

			}
			$(document).on(eventName, el, fun);

		}());

		(function () {
			var eventName = 'touchstart';
			var el = '.style-item';
			var fun = function (event) {

				var $this = $(this);
				var group = $this.attr('data-group');
				info[group].item = $this.attr('data-value');

				$('[data-group="' + group + '"]').removeClass('active');
				$this.addClass('active');
			}

			$(document).on(eventName, el, fun);

		}());


		function addBag(goods_id) {

			var _info = [];

			for (var i in info) {
				var ent = info[i];

				if (!ent.item) {

					msg.s({
						title: '请选择' + ent.title,
					});

					w(1);
					return;
				}

				_info.push(ent.title + '：' + ent.item);
			}


			(function () {

				var url = '/wShop/index.php/Home/shopBag/add';
				var obj = {
					"goods_id": goods_id,
					"info": _info,
				};
				var fun = function (res) {

					try {
						res = JSON.parse(res);
					} catch (error) {
						//转换错误
						return
					}

					if (res.res > 0) {

						msg.s({
							title: "添加成功",
						});

					} else {

					}

				};
				$.post(url, obj, fun);

			}());


		}


	</script>
</body>

</html>