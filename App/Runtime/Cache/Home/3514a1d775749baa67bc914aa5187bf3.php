<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>申请售后</title>
    <link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/amazeui/css/amazeui.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/source/font/iconfont.css" />

    <link href="/wShop/Public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/wShop/Public/Home/dist/a/a.css" />
    <link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/prompt/css/prompt.css" />

    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .yy-list {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
            padding: 0 10px;
            padding-bottom: 100px;

        }

        .box-body {
            padding: 0;
            font-size: 14px;
        }

        .yy-list li {
            padding: 10px 10px;
            border-bottom: solid 1px #ddd;
        }

        .yy-list li .fa {
            float: right;
            opacity: 0;
            transition: all 0.3s;
        }

        .yy-list li.active .fa {
            opacity: 1;
        }

        .info {
            height: 80px;
            background-color: #ffffff;
            padding: 10px;
            color: #777;
            font-size: 14px;
        }

        .info .title {}

        .info .info-right {
            float: right;
        }

        .content {
            padding: 10px;
            margin: 10px 0;
            background-color: #ffffff;
        }

        input[type='text'] {
            width: 100%;
            display: inline-block;
            border: none;
            outline: none;
        }

        .order-id {

            background-color: #ffffff;
            font-size: 14px;
            padding: 10px;
            margin: 10px 0;
        }

        input[type='submit'] {
            width: 100%;
            display: inline-block;
            border: none;
            outline: none;
            background-color: #ff5757;
            color: #fff;
            padding: 10px;
        }
    </style>

</head>

<body>


    <div class="order-id">订单号：<?php echo ($order_id); ?></div>
    <input type="hidden" name='order_id' value="<?php echo ($order_id); ?>">
    <div class="info">
        <div class="title">退款原因

            <span class="info-right">
                <input type="hidden" name="type" id="info-value" value="">
                <span id="info-text">请选择</span>
                <span class="fa fa-chevron-right"></span>
            </span>
        </div>
    </div>

    <div class="content">
        说明：
        <input type="text" name="info" id="info" placeholder="选填" />

    </div>


    <div class="zf-box" data-index='0'>
        <div class="title">
            退款类型
            <i class="fa fa-remove close"></i>
        </div>
        <div class="box-body">

            <ul class="yy-list">
                <li>
                    <span class="yy-title">七天无理由退换货</span>
                    <span class="fa fa-check-square-o"></span>
                </li>
                <li>
                    <span class="yy-title">退运费</span>
                    <span class="fa fa-check-square-o"></span>
                </li>
                <li>
                    <span class="yy-title">仅退款</span>
                    <span class="fa fa-check-square-o"></span>
                </li>
                <li>
                    <span class="yy-title">仅退货</span>
                    <span class="fa fa-check-square-o"></span>
                </li>
                <li>
                    <span class="yy-title">退款退货</span>
                    <span class="fa fa-check-square-o"></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="zz-box" data-index='0'></div>
    <input type="submit" id="post" value="提交">


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
    <script src="/wShop/Public/Home/dist/myOrder/js/myOrder.js" type="text/javascript" charset="utf-8"></script>
    <script src="/wShop/Public/vendor/prompt/js/prompt.js" type="text/javascript" charset="utf-8"></script>
    <script src="/wShop/Public/Home/dist/a/a.js" type="text/javascript" charset="utf-8"></script>
    <script>


        var yy;
        var order_id = '<?php echo ($order_id); ?>';

        (function () {
            var eventName = 'click';
            var el = '.yy-list li';
            var fun = function (event) {

                var $this = $(this);
                $(el).removeClass('active');
                $this.addClass('active');
                yy = $this.find('.yy-title').text();
                $('#info-text').text(yy);
                $('#info-value').val(yy);
            }

            $(document).on(eventName, el, fun);

        }());
        (function () {
            var eventName = 'click';
            var el = '.info';
            var fun = function (event) {

                var $this = $(this);
                showPanel(0);
            }

            $(document).on(eventName, el, fun);

        }());
        (function () {
            var eventName = 'click';
            var el = '#post';
            var fun = function (event) {

                var $this = $(this);
                var info = $('#info').val();

                if (yy == null || yy == '') {

                    prompt.show({
                        text: '请选择原因！',
                        position: 'bottom'
                    });
                    return
                }
                (function () {

                    var url = '';
                    var obj = {
                        order_id: order_id,
                        type: yy,
                        info: info,
                    };
                    var fun = function (res) {

                        if (res == '1') {
                            tool.alert({
                                title: '申请结果',
                                info: '申请成功',
                                yes: function () {
                                    window.location.href = '/wShop/index.php/Home/Order/showList';
                                },
                                no: function () {
                                    window.location.href = '/wShop/index.php/Home/Order/showList';
                                }
                            })
                        } else {

                        }


                    };
                    $.post(url, obj, fun);

                }());




            }

            $(document).on(eventName, el, fun);

        }());



    </script>

</body>

</html>