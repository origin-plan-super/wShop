<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>购物车</title>
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/mui/css/mui.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
	<link href="/wShop/Public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/prompt/css/prompt.css" />


	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/shopBag/css/shopBag.css" />


	<style>
		.address-list {
			font-size: 14px;
			text-align: left;
		}

		.address-list-item {
			border-bottom: solid 1px #ddd;
			padding: 10px 0;
		}

		.address-list-item .address-list-item-title {
			color: #333;
			display: block;
		}

		.address-list-item .address-list-item-info {
			display: block;
			font-size: 13px;
			color: #888;
		}

		.address-list-item-active {
			float: right;
			opacity: 0;
			transition: all 0.3s;
		}
	</style>

</head>

<body>
	<!--顶部导航栏开始-->

	<!--顶部导航栏结束-->


	<ul id="bag-list" class="mui-table-view">

		<?php if(is_array($bag)): $i = 0; $__LIST__ = $bag;if( count($__LIST__)==0 ) : echo "没有购物车数据" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li class="mui-table-view-cell">

				<div class="mui-slider-right mui-disabled">
					<a class="mui-btn mui-btn-success bag-add" data-id='<?php echo ($vol["bag_id"]); ?>'>+</a>
					<a class="mui-btn mui-btn-warning bag-red" data-id='<?php echo ($vol["bag_id"]); ?>'>-</a>
					<a class="mui-btn mui-btn-red bag-del" data-id='<?php echo ($vol["bag_id"]); ?>'>删除</a>
				</div>
				<div class="mui-slider-left mui-disabled">
					<a class="mui-btn mui-btn-success bag-edit" data-id='<?php echo ($vol["bag_id"]); ?>' data-goods='<?php echo ($vol["goods_id"]); ?>'>规格</a>
				</div>
				<div class="mui-slider-handle">

					<div class="bag-panel" data-id='<?php echo ($vol["bag_id"]); ?>' data-goods='<?php echo ($vol["goods_id"]); ?>'>
						<span class="fa fa-circle-o list-isall"></span>
						<img src="/wShop/<?php echo ($vol["head_img"]); ?>" class="good-img" alt="">
						<span class="goods-title">
							<?php echo ($vol["goods_title"]); ?>
						</span>
						<p class="bag-tool">
							￥
							<span class="list-money">
								<?php echo ($vol["money"]); ?>
							</span>
						</p>
						<p class="bag-tool-right ">
							x
							<span class="num">
								<?php echo ($vol["num"]); ?>
							</span>
						</p>
					</div>

				</div>

			</li><?php endforeach; endif; else: echo "没有购物车数据" ;endif; ?>

	</ul>


	<div class="bag-bottom" style="text-overflow: ellipsis;white-space: nowrap;">

		<div class="bag-bottom-left">
			<span class="isAll">
				<span class="fa fa-circle-o">
				</span>
				全选
			</span>

			<span class="money" style="text-overflow: ellipsis;white-space: nowrap;">
				总价：
				<span id="sum">0</span>￥
			</span>

		</div>
		<div class="bag-bottom-right" id="postOrder">
			去结算
		</div>

	</div>

	<div class="zf-box" data-index='0'>
		<div class="title">
			<i class="fa fa-weixin"></i>
			订单已生成
			<i class="fa fa-remove close"></i>
		</div>
		<div class="box-body">
			<img src="/wShop/wx.jpg" alt="">
			<!-- <img src="/wShop/wx2.png" alt=""> -->
			<p>长按识别二维码，添加客服微信号即可下单</p>
		</div>
	</div>

	<div class="zf-box" data-index='1'>
		<div class="title">
			<i class="fa fa-weixin"></i>
			商品参数
			<i class="fa fa-remove close"></i>
		</div>
		<div class="box-body" style="padding:0">

			<div class="style-box">
				<div>当前选择：
					<span id='user_style'></span>
				</div>

				<div>选择规格：</div>
				<div style="text-align: center">
					<div id="colorApp">
						<span class="style-item" v-for='(item,index) in items' data-group='color' :data-value='item'>
							{{item}}
						</span>
					</div>

					<div id="sizeApp">
						<span class="style-item" v-for='(item,index) in items' data-group='size' :data-value='item'>
							{{item}}
						</span>
					</div>
					<div id="size2App">
						<span class="style-item" v-for='(item,index) in items' data-group='size2' :data-value='item'>
							{{item}}
						</span>

					</div>

				</div>

				<button type="button" class="am-btn am-btn-success" id="okStyle">确定</button>

			</div>


		</div>
	</div>

	<div class="zf-box" data-index='address'>
		<div class="title">
			<i class="fa fa-truck"></i>
			请选择收货地址
			<i class="fa fa-remove close"></i>
		</div>
		<div class="box-body">

			<div class="address-list">
				<?php if(empty($address)): ?><div style='text-align: center'>
						<a href="/wShop/index.php/Home/address/add" type="button" class="am-btn am-btn-success">去添加收货地址</a>
					</div><?php endif; ?>
				<?php if(is_array($address)): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><!-- style="opacity: 1;" -->




					<div class="address-list-item " data-id='<?php echo ($vol["address_id"]); ?>'>
						<span class="address-list-item-active" style='<?php if( $vol["is_default"] == 1 ): ?>opacity: 1;<?php endif; ?> '>
							<i class="fa fa-truck"></i>
						</span>
						<span class="address-list-item-title">
							<?php echo ($vol["people"]); ?>，<?php echo ($vol["phone"]); ?>
						</span>
						<span class="address-list-item-info">
							<?php echo ($vol["location"]); ?>
						</span>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>

			</div>


		</div>
	</div>


	<div class="zz-box" data-index='0'></div>
	<div class="zz-box" data-index='1'></div>
	<div class="zz-box" data-index='address'></div>



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
	<script src="/wShop/Public/vendor/mui/js/mui.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/amazeui/js/amazeui.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/vue/vue.js"></script>
	<script src="/wShop/Public/vendor/prompt/js/prompt.js" type="text/javascript" charset="utf-8"></script>

	<script src="/wShop/Public/Home/dist/a/a.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/shopBag/js/shopBag.js" type="text/javascript" charset="utf-8"></script>
	<script>
		(function () {
			var eventName = 'click touchstart';
			var el = '.bag-panel';
			var fun = function (event) {

				var $this = $(this);
				var id = $this.attr('data-id');

				// isAll
				// <!-- <span class="fa fa-check-square-o list-isall"></span> -->
				// 				<span class="fa fa-square-o list-isall"></span>

				var $isall = $this.find('.list-isall');
				$isall.toggleClass('fa-circle-o');
				$isall.toggleClass('fa-circle');
				upSum();

			}

			$(document).on(eventName, el, fun);

		}());


		var goodsInfo = JSON.parse('<?php echo ($goodsInfo); ?>');



		// =====
		var colorApp = new Vue({
			el: '#colorApp',
			data: {
				items: [],
				msg: '',
				count: 0
			},
			methods: {
				add: function () {
					appAdd(this, '新增颜色');
				},
				del: function (index, item) {
					appDel(this, index, item);
				}
			}
		});
		var sizeApp = new Vue({
			el: '#sizeApp',
			data: {
				items: [],
				msg: ''
			},
			methods: {
				msg: ''
			},
			methods: {
				add: function () {
					appAdd(this, '新增大小');
				},
				del: function (index, item) {
					appDel(this, index, item);
				}
			}
		});
		var size2App = new Vue({
			el: '#size2App',
			data: {
				items: [],
				msg: ''

			},
			methods: {
				add: function () {
					appAdd(this, '新增尺码');
				},
				del: function (index, item) {
					appDel(this, index, item);
				}
			}
		});

		// okStyle

		(function () {
			var eventName = 'click touchstart';
			var el = '#okStyle';
			var fun = function (event) {

				var $this = $(this);
				var goods_id = $this.attr('data-id');
				var bag_id = $this.attr('data-bag-id');

				var _info = [];

				for (var i in info) {
					var ent = info[i];

					if (!ent.item) {

						prompt.show({
							text: '请选择' + ent.title,
							position: 'bottom',
						});

						return;
					}
					_info.push(ent.title + '：' + ent.item);
				}

				heidPanel(1);

				goodsInfo[goods_id].user_style = _info;


				(function () {

					var url = '/wShop/index.php/Home/ShopBag/saveStyle';
					var obj = {
						bag_id: bag_id,
						info: _info
					};
					var fun = function (res) {
						try {
							res = JSON.parse(res);
						} catch (error) {
							//转换错误
							return
						}

					};
					$.post(url, obj, fun);

				}());


			}

			$(document).on(eventName, el, fun);

		}());


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
			var eventName = 'click touchstart';
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

		function appAdd(app, title) {

			layer.prompt({
				title: title
			}, function (value, index, elem) {
				$(elem).val('');
				$(elem).focus();
				app.items.push(value);
				appUpdate(app);
				// layer.close(index);
			});

		}
		function appDel(app, index, item) {
			app.items.splice(index, 1);
			appUpdate(app);
		}
		function appUpdate(app) {
			app.msg = '';
			for (var i = 0; i < app.items.length; i++) {
				var item = app.items[i];
				app.msg += item + (i == app.items.length - 1 ? '' : '|');
			}
		}


		(function () {
			var eventName = 'click touchstart';
			var el = '.bag-edit';
			var fun = function (event) {

				var $this = $(this);
				var id = $this.attr('data-id');
				var goods_id = $this.attr('data-goods');


				res = goodsInfo[goods_id];

				colorApp.items = res.color;
				sizeApp.items = res.size;
				size2App.items = res.size2;
				$('#user_style').text(res.user_style);
				$('#okStyle').attr('data-id', goods_id);
				$('#okStyle').attr('data-bag-id', id);

				showPanel(1);



			}

			$(document).on(eventName, el, fun);

		}());





		(function () {
			var eventName = 'click touchstart';
			var el = '.bag-add';
			var fun = function (event) {

				var $this = $(this);
				var id = $this.attr('data-id');


				var num = $this.parents('.mui-table-view-cell').find('.num').text();
				num = parseInt(num);
				upNum($this, ++num, id, true);

			}

			$(document).on(eventName, el, fun);

		}());
		(function () {
			var eventName = 'click touchstart';
			var el = '.bag-red';
			var fun = function (event) {

				var $this = $(this);

				var id = $this.attr('data-id');

				var num = $this.parents('.mui-table-view-cell').find('.num').text();
				num = parseInt(num);
				upNum($this, --num, id, false);





			}

			$(document).on(eventName, el, fun);

		}());


		(function () {
			var eventName = 'click touchstart';
			var el = '.bag-del';
			var fun = function (event) {

				var $this = $(this);

				var id = $this.attr('data-id');


				tool.alert({
					title: '删除',
					info: '真的要删除吗',
					yes: function () {
						delBagListItem($this, id);
					}
				});

			}

			$(document).on(eventName, el, fun);

		}());




		(function () {
			var eventName = 'click touchstart';
			var el = '.isAll';
			var fun = function (event) {

				var $this = $(this);
				var $all = $this.find('.fa');
				$all.toggleClass('fa-circle-o');
				$all.toggleClass('fa-circle');

				var is_all = $all.hasClass('fa-circle');
				checkedAll(is_all);


			}

			$(document).on(eventName, el, fun);

		}());


		function checkedAll(is_all) {
			if (is_all) {

				$('.bag-panel').each(function (index) {
					var $isall = $(this).find('.list-isall');
					$isall.removeClass('fa-circle-o');
					$isall.addClass('fa-circle');

				});


			} else {
				$('.bag-panel').each(function (index) {
					var $isall = $(this).find('.list-isall');
					$isall.addClass('fa-circle-o');
					$isall.removeClass('fa-circle');
				});
			}

			upSum();

		}


		function delBagListItem(el, id) {
			$(el).parents('.mui-table-view-cell').remove();

			(function () {


				var url = '/wShop/index.php/Home/ShopBag/del'
				var obj = {
					bag_id: id
				};
				var fun = function (res) {

					try {
						res = JSON.parse(res);
					} catch (error) {
						//转换错误
						return
					}

					if (res.res > 0) {


					}
				};
				$.post(url, obj, fun);

			}());



		}


		function upNum(el, num, id, type) {

			if (num <= 0) {
				//没有了，应该删了

				tool.alert({
					title: '删除',
					info: '真的要删除吗',
					yes: function () {
						delBagListItem(el, id);
					}
				});

				return;
			}

			if (type === undefined) {
				type = true;
			}
			$(el).parents('.mui-table-view-cell').find('.num').text(num);

			upSum();

			(function () {


				var url = type ? '/wShop/index.php/Home/ShopBag/add1' : '/wShop/index.php/Home/ShopBag/red';

				var obj = {
					bag_id: id
				};
				var fun = function (res) {


					try {
						res = JSON.parse(res);
					} catch (error) {
						//转换错误
						return
					}
				};
				$.post(url, obj, fun);

			}());



		}
		function upSum() {
			// list-money

			var money = 0.00;

			$('.bag-panel').each(function (index) {
				var $isall = $(this).find('.list-isall');
				if ($isall.hasClass('fa-circle')) {
					var m = $(this).find('.list-money').text();
					var num = $(this).find('.num').text();

					money += parseFloat(m) * parseInt(num);
				}
			});
			if (money < 0) {
				money = 0.00;
			}
			$('#sum').text(money.toFixed(2));

		}


		(function () {

			var eventName = 'click touchend';
			var el = '#postOrder';
			var fun = function (event) {
				postOrder();
			}

			$(document).on(eventName, el, fun);

		}());


		// showPanel('address');
		var address;
		// = ;
		(function () {
			var eventName = 'click touchstart';
			var el = '.address-list-item';
			var fun = function (event) {

				var $this = $(this);
				var id = $this.attr('data-id');
				address = id;
				$('.address-list-item-active').css('opacity', '0');
				$this.find('.address-list-item-active').css('opacity', '1');
			}

			$(document).on(eventName, el, fun);

		}());

		function postOrder() {

			address = '<?php echo ($address_is_default); ?>';

			// if (!address) {
			// 	showPanel('address');
			// 	return;
			// }

			var order = [];

			$('.bag-panel').each(function (index) {
				var $this = $(this);
				var $isall = $(this).find('.list-isall');
				if ($isall.hasClass('fa-circle')) {
					var id = $this.attr('data-id');
					var goods_id = $this.attr('data-goods');
					var goods_id = $this.attr('data-goods');
					var num = $this.find('.num').text();
					var item = {
						goods_id: goods_id,
						num: num
					};

					order.push(item);
				}
			});

			if (order.length <= 0) {

				prompt.show({
					text: '请先选择商品~',
					position: 'bottom'
				})
				return;
			}

			showPanel(0);

			(function () {

				var url = '/wShop/index.php/Home/Order/add';
				var obj = {
					ids: order,
					address_id: address
				};
				var fun = function (res) {


					try {
						res = JSON.parse(res);
					} catch (error) {
						//转换错误
						return
					}
					if (res.res > 0) {
						//成功
					} else {
						//失败
					}

				};
				$.post(url, obj, fun);

			}());


			// strToArr


		}
	</script>



</body>

</html>