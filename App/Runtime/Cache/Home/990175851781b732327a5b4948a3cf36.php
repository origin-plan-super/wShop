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
            padding-bottom: 50px;
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

        a:focus,
        a:hover {
            color: #777;
            text-decoration: none;

        }

        .tool {
            text-align: right;
        }

        .tool-btn {
            display: inline-block;
            border: solid 1px #777;
            color: #777777;
            border-radius: 5px;
            padding: 3px;
            text-align: center;
            margin: 0 5px;
        }

        .tool-right {
            float: right;
        }

        .tool-btn-no {
            border: none;
        }

        .tool-btn-block {
            display: block;
        }

        .text-red {
            color: #ff0000;
        }

        .my-btn {
            margin: 10px;
            margin-bottom: 10px;
        }

        hr {
            margin: 0 0;
        }
    </style>
</head>

<body>

    <a class="tool-btn tool-btn-block my-btn" href="/wShop/index.php/Home/Address/add">新增收货地址</a>
    <hr>
    <div class="list-box">

        <?php if(is_array($address)): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "没有地址！" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><div class="list-item">
                <div class="list-body">
                    <div class="title">
                        <?php echo ($vol["people"]); ?>，<?php echo ($vol["phone"]); ?>
                    </div>
                    <div class="info">
                        <?php echo ($vol["location"]); ?>
                    </div>
                    <div class="tool">

                        <?php if($vol["is_default"] == 1): ?><div class="tool-btn tool-btn-no set-default text-red">
                                默认地址
                            </div>
                            <?php else: ?>
                            <div class="tool-btn set-default">
                                <a href="/wShop/index.php/Home/Address/setDefault/address_id/<?php echo ($vol["address_id"]); ?>">设为默认</a>
                            </div><?php endif; ?>

                        <div class="tool-btn set-default tool-remove">
                            <a href="/wShop/index.php/Home/Address/del/address_id/<?php echo ($vol["address_id"]); ?>">删除</a>
                        </div>

                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "没有地址！" ;endif; ?>




    </div>


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






</body>

</html>