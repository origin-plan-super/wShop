<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>搜索</title>
    <link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/mui/css/mui.min.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/mui/css/mui.indexedlist.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/brand/css/brand.css" />

    <style>
        .am-header {
            padding: 1px;
            height: auto;
        }

        .test * {
            display: inline-block;
        }

        .test input {
            width: 80%;
        }

        .mui-bar .mui-input-row .mui-btn {
            background-color: #ffffff;
            padding: 6px;
        }

        .box {
            position: absolute;
            top: 50px;
            bottom: 50px;
            overflow: auto;
        }
    </style>
</head>

<body>
    <!--顶部的搜索框 开始-->
    <header class="mui-bar mui-bar-nav">
        <div class="mui-input-row mui-search">
            <form action="" method="post">
                <div class="test">
                    <input type="search" class="mui-input-clear" name="key" placeholder="搜索喜欢的宝贝">
                    <button type="submit" class="mui-btn mui-btn-outlined">搜索</button>
                </div>
            </form>
        </div>
    </header>


    <div class="box">
        <div class="p-b-100 pbl">

            <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods-list-box">
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
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>


    <!--底部的导航栏 开始-->

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