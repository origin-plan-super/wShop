<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>关于我们</title>
    <link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />

    <style>
        .box {
            position: fixed;
            width: 100%;
            top: 30%;
            transform: translateY(-50%)
        }

        .title {
            text-align: center;
            font-size: 30px;
        }

        .v {
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body>


    <div class="box">
        <div class="title">
            微商城
        </div>
        <div class="v">
            版本V0.0.1
        </div>
    </div>

    <?php if(3 != 3): ?><a href="/wShop/index.php/Home/query/query" class="query">
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

    <script src="/wShop/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="/wShop/Public/Home/dist/a/a.js" type="text/javascript" charset="utf-8"></script>

</body>

</html>