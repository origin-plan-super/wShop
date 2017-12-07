<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>我的订单</title>
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />
	<link href="/wShop/Public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/prompt/css/prompt.css" />

	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/myOrder/css/myOrder.css" />
	<style>
		body {
			background-color: #f8f8f8;
		}

		.goods-group {
			background-color: #fff;
			margin: 10px 0;
			font-size: 14px;
		}

		a {
			text-decoration: none;
			color: #777777;
		}

		a:focus,
		a:hover {
			color: #777;
			text-decoration: none;

		}

		.goods-group-head {
			border-bottom: solid 1px #ddd;
		}


		.add-time {
			width: 49%;
			display: inline-block;
			border-right: solid 1px #ddd;
			padding: 10px 0;
			text-align: center;
		}

		.goods-list {
			padding: 0 20px;
		}

		.goods-item {
			position: relative;
			border-bottom: solid 1px #ddd;
			padding: 10px 0;
			margin: 0;
		}

		.goods-item-img {}

		.goods-item-img img {
			width: 60px;
			height: 60px;
			border-radius: 50%;
		}

		.goods-item-title {
			position: absolute;
			padding-left: 15px;
		}

		.goods-item-info {
			position: absolute;
			bottom: 10px;
			width: 100%;
			padding-left: 70px;

		}

		.goods-item-info .num {
			text-align: right;
			float: right
		}

		.am-tabs-bd .am-tab-panel {
			padding: 0;
		}

		.goods-group-footer {
			position: relative;
			padding: 10px;
			text-align: right;
		}

		.sub-money {
			display: inline-block;
			padding: 0 10px;
		}

		.tool-btn {
			border: solid 1px #ddd;
			padding: 5px 10px;
			border-radius: 3px;
			display: inline-block;
			color: #777777;
		}
	</style>

</head>

<body>

	<!--选项卡开始-->
	<div data-am-widget="tabs" class="am-tabs am-tabs-d2">
		<ul class="am-tabs-nav am-cf">
			<li class="<?php if($_pages == -1): ?>am-active<?php endif; ?>">
				<a href="[data-tab-panel-0]">全部</a>
			</li>
			<li class="<?php if($_pages == 1+1): ?>am-active<?php endif; ?>">
				<a href="[data-tab-panel-1]">待付款</a>
			</li>
			<li class="<?php if($_pages == 2+1): ?>am-active<?php endif; ?>">
				<a href="[data-tab-panel-2]">待发货</a>
			</li>
			<li class="<?php if($_pages == 3+1): ?>am-active<?php endif; ?>">
				<a href="[data-tab-panel-3]">待收货</a>
			</li>
			<li class="<?php if($_pages == 4+1): ?>am-active<?php endif; ?>">
				<a href="[data-tab-panel-4]">交易成功</a>
			</li>
			<li class="<?php if($_pages == 5+1): ?>am-active<?php endif; ?>">
				<a href="[data-tab-panel-5]">退款/售后</a>
			</li>
		</ul>
		<div class="am-tabs-bd">
			<?php if(is_array($order)): $index = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($index % 2 );++$index; if($index === 1 ): ?><div data-tab-panel-<?php echo ($index); ?> class="am-tab-panel <?php if($_pages == -1): ?>am-active<?php endif; ?>">
						<?php if(is_array($vol)): $i = 0; $__LIST__ = $vol;if( count($__LIST__)==0 ) : echo "没有订单数据！" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods-group">
								<div class="goods-group-head" data-order-id='<?php echo ($vo["order_info"]["order_id"]); ?>'>
									<span class="add-time">
										<?php echo ($vo["order_info"]["t1_add_time"]); ?>
									</span>
									<span class="add-time">
										<?php echo ($vo["order_info"]["order_id"]); ?>
									</span>

								</div>
								<?php if(is_array($vo["goods_list"])): $i = 0; $__LIST__ = $vo["goods_list"];if( count($__LIST__)==0 ) : echo "没有订单数据！" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="goods-list">
										<div class="goods-item" data-goods-id='<?php echo ($v["goods_id"]); ?>'>
											<span class="goods-item-img">
												<img src="/wShop/<?php echo ($v["head_img"]); ?>" alt="">
											</span>
											<span class="goods-item-title">
												<?php echo ($v["goods_title"]); ?>
											</span>
											<div class="goods-item-info">
												<span class="money">
													￥<?php echo ($v["goods_money"]); ?>
												</span>
												<span class="num">
													x<?php echo ($v["num"]); ?>
												</span>
											</div>

										</div>
									</div><?php endforeach; endif; else: echo "" ;endif; ?>

								<div class="goods-group-footer">
									<span class="sub-money">
										订单总价：￥<?php echo ($vo["order_info"]["order_money"]); ?>
									</span>
								</div>

							</div><?php endforeach; endif; else: echo "没有订单数据！" ;endif; ?>
					</div>
					<?php else: ?>
					<div data-tab-panel-<?php echo ($index); ?> class="am-tab-panel <?php if($index == $_pages): ?>am-active<?php endif; ?>">

						<?php if(is_array($vol)): $i = 0; $__LIST__ = $vol;if( count($__LIST__)==0 ) : echo "没有订单数据！" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods-group">
								<div class="goods-group-head" data-order-id='<?php echo ($vo["order_info"]["order_id"]); ?>'>
									<span class="add-time">
										<?php echo ($vo["order_info"]["t1_add_time"]); ?>
									</span>
									<span class="add-time">
										<?php echo ($vo["order_info"]["order_id"]); ?>
									</span>
								</div>
								<?php if(is_array($vo["goods_list"])): $i = 0; $__LIST__ = $vo["goods_list"];if( count($__LIST__)==0 ) : echo "没有订单数据！" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="goods-list">
										<div class="goods-item" data-goods-id='<?php echo ($v["goods_id"]); ?>'>
											<span class="goods-item-img">
												<img src="/wShop/<?php echo ($v["head_img"]); ?>" alt="">
											</span>
											<span class="goods-item-title">
												<?php echo ($v["goods_title"]); ?>
											</span>
											<div class="goods-item-info">
												<span class="money">
													￥<?php echo ($v["goods_money"]); ?>
												</span>
												<span class="num">
													x<?php echo ($v["num"]); ?>
												</span>
											</div>
										</div>
									</div><?php endforeach; endif; else: echo "没有订单数据！" ;endif; ?>

								<div class="goods-group-footer">
									<span class="sub-money">
										订单总价：￥<?php echo ($vo["order_info"]["order_money"]); ?>
									</span>
									<!-- <?php echo ($index); ?> -->
									<?php if($index === 2 ): ?><a href='/wShop/index.php/Home/Order/cancel/order_id/<?php echo ($vo["order_info"]["order_id"]); ?>/pages/<?php echo ($index); ?>' class="tool-btn">取消订单</a>
										<a href='javascript:;' class="tool-btn gofk">去付款</a><?php endif; ?>

									<?php if($index === 3 ): ?><a href='javascript:;' class="tool-btn txfh">提醒发货</a>
										<!-- <a href='/wShop/index.php/Home/Order/remind/order_id/<?php echo ($vo["order_info"]["order_id"]); ?>' class="tool-btn">提醒发货</a> --><?php endif; ?>
									<?php if($index === 4 ): ?><a href='/wShop/index.php/Home/Order/ok/order_id/<?php echo ($vo["order_info"]["order_id"]); ?>/pages/<?php echo ($index); ?>' class="tool-btn">确认收货</a>

										<br>【快递单号】<?php echo ($vo["order_info"]["order_on"]); ?>
										<br>【快递公司】<?php echo ($vo["order_info"]["order_gs"]); endif; ?>
									<?php if($index === 5 ): ?><a href='/wShop/index.php/Home/Order/sc/order_id/<?php echo ($vo["order_info"]["order_id"]); ?>/pages/<?php echo ($index); ?>' class="tool-btn">售后</a><?php endif; ?>
									<?php if($index === 6 ): ?><div style="color:#f00;padding:5px 20px ;">
											<div>
												退款类型：<?php echo ($vo["order_info"]["sc_type"]); ?>
											</div>
											<div>
												退款详情：<?php echo ($vo["order_info"]["sc_info"]); ?>
											</div>
											<div>
												处理结果：
												<?php if($vo["order_info"]["state"] == 5 ): ?>已处理<?php endif; ?>
												<?php if($vo["order_info"]["state"] == 4 ): ?>正在处理<?php endif; ?>
											</div>
										</div><?php endif; ?>
								</div>

							</div><?php endforeach; endif; else: echo "没有订单数据！" ;endif; ?>



					</div><?php endif; endforeach; endif; else: echo "没有订单数据！" ;endif; ?>





		</div>
	</div>
	<!--选项卡结束-->

	<!--底部导航开始-->
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
	<!--底部导航结束-->


	<div class="zf-box" data-index='0'>
		<div class="title">
			<i class="fa fa-weixin"></i>
			扫描二维码付款
			<i class="fa fa-remove close"></i>
		</div>
		<div class="box-body">
			<img src="/wShop/wx.jpg" alt="">
			<!-- <img src="/wShop/wx2.png" alt=""> -->
			<p>长按识别二维码，添加客服微信号即可下单</p>
		</div>
	</div>
	<div class="zz-box" data-index='0'></div>



	<script src="/wShop/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/amazeui/js/amazeui.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/myOrder/js/myOrder.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/prompt/js/prompt.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/a/a.js" type="text/javascript" charset="utf-8"></script>

	<script>

		(function () {
			var eventName = 'click';
			var el = '.goods-item';
			var fun = function (event) {

				var $this = $(this);
				var id = $this.attr('data-goods-id');

				window.location.href = '/wShop/index.php/Home/goodsInfo/goodsInfo/goods_id/' + id + '/pages/3';
				w(id);
			}
			$(document).on(eventName, el, fun);

		}());
		(function () {
			var eventName = 'click';
			var el = '.goods-group-head';
			var fun = function (event) {

				var $this = $(this);
				var id = $this.attr('data-order-id');
				w(id);

				// window.location.href = '/wShop/index.php/Home/goodsInfo/goodsInfo/goods_id/' + id;
			}

			$(document).on(eventName, el, fun);

		}());
		(function () {
			var eventName = 'click';
			var el = '.gofk';
			var fun = function (event) {

				var $this = $(this);
				var id = $this.attr('data-order-id');
				showPanel('0');

			}

			$(document).on(eventName, el, fun);

		}());

		(function () {
			var eventName = 'click';
			var el = '.txfh';
			var fun = function (event) {

				var $this = $(this);
				var id = $this.attr('data-order-id');

				prompt.show({
					text: '提醒成功~',
					position: 'bottom'
				})

			}

			$(document).on(eventName, el, fun);

		}());

	</script>


</body>

</html>