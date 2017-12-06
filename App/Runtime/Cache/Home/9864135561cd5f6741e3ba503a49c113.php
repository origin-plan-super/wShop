<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />


    <title>收货地址管理</title>

    <style>
        body {
            padding: 0;
            margin: 0;
            background-color: #ffffff;
        }

        .list-box {
            padding: 10px;
        }

        .list-item {
            padding: 10px 5px;
            border-bottom: solid 1px #ddd;
            font-size: 14px;
        }

        .info {
            color: #999;
            font-size: 13px;
            padding: 5px 0;
        }

        .default {
            color: #f00;
        }

        a {
            text-decoration: none;
            color: #777777;
        }

        .tool-btn {
            display: inline-block;
            border: solid 1px #777;
            color: #777777;
            border-radius: 5px;
            padding: 3px;
        }

        .tool-right {
            float: right;
        }

        .tool-btn-no {
            border: none;
        }

        .text-red {
            color: #ff0000;
        }
    </style>
</head>

<body>

    <div class="list-box">
        <div class="list-item">
            <div class="list-body">
                <div class="title">
                    代码狮，11012012138
                </div>
                <div class="info">
                    中国上海黄浦区黄浦江上中国上海黄浦区黄浦江上
                </div>
                <div class="tool">
                    <div class="tool-btn set-default">
                        <a href="">设为默认</a>
                    </div>
                    <div class="tool-btn set-default tool-right tool-remove">
                        <a href="">删除</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="list-item">
            <div class="list-body">
                <div class="title">
                    代码狮，11012012138
                </div>
                <div class="info">
                    中国上海黄浦区黄浦江上
                </div>
                <div class="tool">
                    <div class="tool-btn tool-btn-no set-default text-red">
                        默认地址
                    </div>
                    <div class="tool-btn set-default tool-right tool-remove">
                        <a href="">删除</a>
                    </div>
                </div>
            </div>

        </div>


        <div class="list-item">
            <div class="list-body">
                <div class="title">
                    代码狮，11012012138
                </div>
                <div class="info">
                    中国上海黄浦区黄浦江上
                </div>
                <div class="tool">
                    <div class="tool-btn set-default">
                        <a href="">设为默认</a>
                    </div>
                    <div class="tool-btn set-default tool-right tool-remove">
                        <a href="">删除</a>
                    </div>
                </div>
            </div>

        </div>

    </div>


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






</body>

</html>