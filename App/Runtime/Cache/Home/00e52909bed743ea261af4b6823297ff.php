<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>首页</title>
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
	<link rel="stylesheet" href="/wShop/Public/vendor/swiper/4.0.5/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/index/css/index.css" />

</head>

<body>

	<!--顶部的导航栏  结束-->
	<div class="container-fluid a-k">
		<!--滑动开始-->
		<div id="topNav" class="swiper-container gallery-thumbs">
			<div class="swiper-wrapper swiper-bc">

				<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i; if($i == 1 ): ?><div class="swiper-slide active" data-index="<?php echo ($i); ?>">
							<span><?php echo ($vol["nav_title"]); ?></span>
						</div>

						<?php else: ?>

						<div class="swiper-slide" data-index="<?php echo ($i); ?>">
							<span><?php echo ($vol["nav_title"]); ?></span>
						</div><?php endif; endforeach; endif; else: echo "暂时没有数据" ;endif; ?>

			</div>
		</div>

		<div class="swiper-container gallery-top">
			<div class="swiper-wrapper">


				<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><!-- 这里是首页 -->



					<div class="swiper-slide">


						<!--轮播图开始-->
						<?php if(!empty($vol["carousel"])): ?><div class="swiper-containerl swiper-container-horizontal" id="swiper-container1">
								<div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">

									<?php if(is_array($vol["carousel"])): $i = 0; $__LIST__ = $vol["carousel"];if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
											<div class="img-box" style="background-image: url(/wShop/<?php echo ($vo["carousel_url"]); ?>)"></div>
										</div><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
								</div>
								<div class="swiper-paginationl swiper-pagination-clickable swiper-pagination-bullets">

									<?php if(is_array($vol["carousel"])): $i = 0; $__LIST__ = $vol["carousel"];if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="swiper-pagination-bullet "></span><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
								</div>
							</div><?php endif; ?>
						<!--轮播图结束-->

						<div class="">
							<div class="p-b-100 pbl">
								<?php if(is_array($vol["goods"])): $i = 0; $__LIST__ = $vol["goods"];if( count($__LIST__)==0 ) : echo "没有商品" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods-list-box">
										<a href="/wShop/index.php/Home/goodsInfo/goodsInfo/goods_id/<?php echo ($vo["goods_id"]); ?>">
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
					</div><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
			</div>
		</div>
	</div>
	<!--底部的导航栏 开始-->

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

	<!--底部的导航栏 开始-->
	<script src="/wShop/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/swiper/3.4.2/swiper.min.js" type="text/javascript" charset="utf-8"></script>

	<script>

		var mySwiper = new Swiper('.swiper-containerl', {
			pagination: '.swiper-paginationl',
			paginationClickable: true,
		})

	</script>


	<script src="/wShop/Public/vendor/amazeui/js/amazeui.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/index/js/index.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/a/a.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		// gotop2(".gallery-top .swiper-slide");


		login();
		function login() {
			//微信登录
			w(1);

		}

		var swiperH = new Swiper('.swiper-container-h', {
			spaceBetween: 50,
			pagination: {
				el: '.swiper-pagination-h',
				clickable: true,
			},
		});

		var swiperV = new Swiper('.swiper-container-v', {
			direction: 'vertical',
			spaceBetween: 50,
			pagination: {
				el: '.swiper-pagination-v',
				clickable: true,
			},
		});


		//          轮播图样式

	</script>
</body>

</html>