<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>品牌页面</title>
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/mui/css/mui.min.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/mui/css/mui.indexedlist.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
	<link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/brand/css/brand.css" />
	<style>
		.mui-indexed-list-inner {
			padding-bottom: 50px;
		}
	</style>
</head>

<body>


	<div class="mui-content">
		<div id='list' class="mui-indexed-list">
			<div class="mui-indexed-list-search mui-input-row mui-search" style="display: none;">
				<input type="search" class="mui-input-clear mui-indexed-list-search-input" placeholder="搜索机场">
			</div>
			<div class="mui-indexed-list-bar list-bc">
				<a>A</a>
				<a>B</a>
				<a>C</a>
				<a>D</a>
				<a>E</a>
				<a>F</a>
				<a>G</a>
				<a>H</a>
				<a>I</a>
				<a>J</a>
				<a>K</a>
				<a>L</a>
				<a>M</a>
				<a>N</a>
				<a>O</a>
				<a>P</a>
				<a>Q</a>
				<a>R</a>
				<a>S</a>
				<a>T</a>
				<a>U</a>
				<a>V</a>
				<a>W</a>
				<a>X</a>
				<a>Y</a>
				<a>Z</a>
				<a>#</a>
			</div>
			<div class="mui-indexed-list-alert"></div>
			<div class="mui-indexed-list-inner">
				<div class="mui-indexed-list-empty-alert">没有数据</div>
				<div class="brand-font">
					<span class="brand-font-line">品牌</span>
				</div>
				<ul class="mui-table-view brand-top">


					<?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "没有品牌信息！" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i; if(getType($vol) == 'string' ): ?><li data-group="<?php echo ($vol); ?>" class="mui-table-view-divider mui-indexed-list-group"><?php echo ($vol); ?></li>
							<?php else: ?>
							<li data-value="<?php echo ($vol["brand_title"]); ?>" data-tags="<?php echo ($vol["brand_title"]); ?>" class="mui-table-view-cell mui-indexed-list-item">
								<a href="/wShop/index.php/Home/Class/show/brand_id/<?php echo ($vol["brand_id"]); ?>"><?php echo ($vol["brand_title"]); ?></a>
							</li><?php endif; endforeach; endif; else: echo "没有品牌信息！" ;endif; ?>

				</ul>
			</div>
		</div>
	</div>


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
	<script src="/wShop/Public/vendor/mui/js/mui.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/vendor/mui/js/mui.indexedlist.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/brand/js/brand.js" type="text/javascript" charset="utf-8"></script>
	<script src="/wShop/Public/Home/dist/a/a.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" charset="utf-8">
		//		    判断导航栏
		//			isNav(".mui-bar");
		mui.init();
		mui.ready(function () {
			var header = document.querySelector('header.mui-bar');
			var list = document.getElementById('list');
			//calc hieght
			list.style.height = 100 + 'vh';
			//create
			window.indexedList = new mui.IndexedList(list);
		});
			//			gotop();
	</script>
</body>

</html>