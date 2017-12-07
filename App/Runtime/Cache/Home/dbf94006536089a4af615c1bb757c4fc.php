<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>分类</title>
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
	<!-- <link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/swiper/3.4.2/swiper.min.css" /> -->
	<link rel="stylesheet" href="/wShop/Public/vendor/swiper/4.0.5/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/class/css/class.css" />
	<style>
		.z-box {
			position: fixed;
			top: 0;
			bottom: 50px;
			left: 0;
			right: 0;
			overflow: hidden;
		}

		.top-nav {
			width: 100%;
			text-align: center;
			background-color: #ffffff;
		}

		.top-nav-item:nth-child(1) {
			/* border-right: solid 1px #777 */
		}

		.top-nav-item {
			display: inline-block;
			width: 49%;
			padding: 10px 0;
		}

		.top-nav-item.active {
			border-bottom: solid 2px #777;

		}

		.a-panel {
			position: absolute;
			height: 100%;
			width: 100%;
			transition: all 0.3s;
			opacity: 0;
			overflow: hidden;
			z-index: -1;
		}

		.a-panel.active {
			opacity: 1;
			z-index: 999;
		}

		.my-panel {
			overflow: auto;
			height: 100%;
			padding-bottom: 100px;
		}


		.a-cf.my-panel-2 {
			overflow: auto;
			max-height: 100%;
			position: absolute;
			top: 0;
			bottom: 50px;
		}

		.my-panel-2 {
			overflow: auto;
			max-height: 100%;
		}
	</style>

</head>

<body>

	<div class="z-box">

		<!--滑动开始-->
		<div class="top-nav">
			<div data-active='[data-panel="0"]' class="top-nav-item active">商品</div>
			<div data-active='[data-panel="1"]' class="top-nav-item  ">分类</div>
		</div>

		<div class="a-panel active" data-panel='0'>
			<div class="my-panel ">
				<div class="pbl">
					<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "没有商品" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods-list-box">
							<a href="/wShop/index.php/Home/goodsInfo/goodsInfo/goods_id/<?php echo ($vo["goods_id"]); ?>">
								<!-- <a href="#"> -->
								<div class="goods-list">
									<div class="goods-img am-text-middle">
										<img src="/wShop/<?php echo ($vo["head_img"]); ?>" class="am-text-middle" alt="图片错误！">
									</div>
									<div class="goods-info">
										<div><?php echo ($vo["goods_title"]); ?></div>
										<div><?php echo ($vo["money"]); ?>￥</div>
									</div>
								</div>
							</a>
						</div><?php endforeach; endif; else: echo "没有商品" ;endif; ?>
				</div>
			</div>

		</div>
		<div class="a-panel  " data-panel='1' style="background-color: #fff">
			<div class="my-panel-2">

				<div id="someTabs" data-am-widget="tabs" data-a-widget="tabs" class="am-tabs am-tabs-default a-tabs a-tabs-default">
					<!--分类左边的 竖着的选项卡 开始-->


					<ul class="am-tabs-nav am-cf a-tabs-nav a-cf my-panel-2">



						<li class="am-active">
							<a href="/wShop/index.php/Home/Class/show/brand_id/<?php echo ($brand_id); ?>">
								全部分类
							</a>
						</li>

						<?php if(is_array($class_1)): $i = 0; $__LIST__ = $class_1;if( count($__LIST__)==0 ) : echo "没有分类！" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li class="">
								<a href="[data-tab-panel-<?php echo ($i); ?>]"><?php echo ($vol["class_title"]); ?></a>
							</li><?php endforeach; endif; else: echo "没有分类！" ;endif; ?>

					</ul>
					<!--分类左边的 竖着的选项卡 结束-->



					<div class="am-tabs-bd am-tabs-bd-ofv a-tabs-bd a-tabs-bd-ofv ">

						<div data-tab-panel class="am-tab-panel am-active a-tab-panel">

							<ul class="a-list list-sm">
								<li>
									<a href="/wShop/index.php/Home/Class/show/brand_id/<?php echo ($brand_id); ?>">
										查看全部分类商品
									</a>
								</li>
							</ul>

						</div>

						<?php if(is_array($class_1)): $i = 0; $__LIST__ = $class_1;if( count($__LIST__)==0 ) : echo "没有分类！" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><div data-tab-panel-<?php echo ($i); ?> class="am-tab-panel a-tab-panel my-panel-2">
								<!-- 循环class2 -->
								<ul class="a-list list-sm">
									<?php if(is_array($vol["class_2"])): $i = 0; $__LIST__ = $vol["class_2"];if( count($__LIST__)==0 ) : echo "没有分类！" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
											<a href="/wShop/index.php/Home/Class/show/brand_id/<?php echo ($brand_id); ?>/class_id/<?php echo ($vo["class_id"]); ?>">
												<span class=""><?php echo ($vo["class_title"]); ?></span>
											</a>
										</li><?php endforeach; endif; else: echo "没有分类！" ;endif; ?>
								</ul>
							</div><?php endforeach; endif; else: echo "没有分类！" ;endif; ?>
					</div>
				</div>
			</div>

		</div>

	</div>
	<!--底部导航栏开始-->
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
	<!--底部导航栏结束-->

	<script src="/wShop/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/amazeui/js/amazeui.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/swiper/3.4.2/swiper.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/class/js/class.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/a/a.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/class/js/class.js" type="text/javascript" charset="utf-8"></script>

	<script type="text/javascript">


		$(document).on('click touchstart', '.top-nav-item', function () {

			var $this = $(this);
			$('.top-nav-item').removeClass('active');
			$this.addClass('active');
			var panel = $this.attr('data-active');
			$panel = $(panel);
			$('.a-panel').removeClass('active');
			$panel.addClass('active');

		});



	</script>
</body>

</html>