<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>微商城后台</title>
    <!-- css -->
<link href="/wShop/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">
<link href="/wShop/Public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="/wShop/Public/vendor/animate/animate.css" rel="stylesheet" type="text/css">
<link href="/wShop/Public/vendor/spinkit/spinkit.css" rel="stylesheet" type="text/css">


<!-- js -->
<script src="/wShop/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="/wShop/Public/vendor/vue/vue.js"></script>
<script src="/wShop/Public/vendor/layer/layer.js"></script>
<script src="/wShop/Public/vendor/layui/layui.js"></script>
<!--  -->
<script src='/wShop/Public/vendor/mTips/mTips.js'></script>

<script src="/wShop/Public/Admin/dist/tool/tool.js"></script>


<script>



    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/, ' ');
    }

    function saveInfo(save, f) {
        (function () {
            var url = '/wShop/index.php/Admin/Use/saveField';
            var obj = save;
            var fun = function (res) {

                try {
                    res = JSON.parse(res);
                } catch (error) {
                    //转换错误
                    layer.msg('异步接口出错！', {
                        anim: 6
                    });
                    return
                }


                if (f != null) {
                    f(res);
                    return;
                }
                if (res.res > 0) {
                    layer.msg('修改成功！');
                } else {
                    layer.msg('修改失败：' + res.msg, {
                        anim: 6
                    });
                }


            };
            $.post(url, obj, fun);

        }());

    }
    function del(delObj, f) {

        (function () {

            var url = '/wShop/index.php/Admin/Use/del';
            var obj = delObj;
            var fun = function (res) {

                try {
                    res = JSON.parse(res);
                } catch (error) {
                    //转换错误
                    layer.msg('异步接口出错！', {
                        anim: 6
                    });
                    return
                }
                if (res.res > 0) {
                    layer.msg('删除成功！');
                    if (f != null) {
                        f(res);
                    }

                } else {
                    layer.msg('删除失败：' + res.msg, {
                        anim: 6
                    });
                }
            };
            $.post(url, obj, fun);

        }());
    }

    function delAll(obj, f) {

        (function () {

            var url = '/wShop/index.php/Admin/Use/delAll';
            var fun = function (res) {

                try {
                    res = JSON.parse(res);
                } catch (error) {
                    //转换错误
                    layer.msg('异步接口出错！', {
                        anim: 6
                    });
                    return
                }

                if (res.res > 0) {
                    layer.msg('删除成功！');
                    if (f != null) {
                        f(res);
                    }


                } else {
                    layer.msg('删除失败：' + res.msg, {
                        anim: 6
                    });
                }
            };
            $.post(url, obj, fun);

        })();

    }
    //将字符串按照格式转化成数组或者json
    function strToArr(str, code, f) {

        var array = str.split(code);
        var arr = [];

        for (var i = 0; i < array.length; i++) {
            var element = array[i];
            if (f != null) {

                if (typeof (f) == 'string') {
                    arr[i] = {};
                    arr[i][f] = element;

                } else {
                    arr[i] = f(i, arr, element);
                }


            } else {
                arr[i] = element;
            }
        }
        return arr;

    }


    //回调控制
    var callback = function () {
        this._no;
        this._yes;
        this.yes = function (f) {
            this._yes = f;
            return this;
        };
        this.no = function (f) {
            this._no = f;
            return this;
        };
    }

    function addAll(obj) {

        var _callback = new callback();

        (function () {

            var url = '/wShop/index.php/Admin/Use/addAll';
            var fun = function (res) {

                try {
                    res = JSON.parse(res);
                    _callback._yes(res);
                } catch (error) {
                    //异步接口出错！
                    e(error);
                    _callback._no(res);
                }

            };
            $.post(url, obj, fun);

        }());

        return _callback;

    }

    var HtmlUtil = {
        /*1.用浏览器内部转换器实现html转码*/
        htmlEncode: function (html) {
            //1.首先动态创建一个容器标签元素，如DIV
            var temp = document.createElement("div");
            //2.然后将要转换的字符串设置为这个元素的innerText(ie支持)或者textContent(火狐，google支持)
            (temp.textContent != undefined) ? (temp.textContent = html) : (temp.innerText = html);
            //3.最后返回这个元素的innerHTML，即得到经过HTML编码转换的字符串了
            var output = temp.innerHTML;
            temp = null;
            return output;
        },
        /*2.用浏览器内部转换器实现html解码*/
        htmlDecode: function (text) {
            //1.首先动态创建一个容器标签元素，如DIV
            var temp = document.createElement("div");
            //2.然后将要转换的字符串设置为这个元素的innerHTML(ie，火狐，google都支持)
            temp.innerHTML = text;
            //3.最后返回这个元素的innerText(ie支持)或者textContent(火狐，google支持)，即得到经过HTML解码的字符串了。
            var output = temp.innerText || temp.textContent;
            temp = null;
            return output;
        }
    };



    function Base64() {

        // private property  
        _keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        // public method for encoding  
        this.encode = function (input) {
            var output = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;
            input = _utf8_encode(input);
            while (i < input.length) {
                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);
                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;
                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }
                output = output +
                    _keyStr.charAt(enc1) + _keyStr.charAt(enc2) +
                    _keyStr.charAt(enc3) + _keyStr.charAt(enc4);
            }
            return output;
        }

        // public method for decoding  
        this.decode = function (input) {
            var output = "";
            var chr1, chr2, chr3;
            var enc1, enc2, enc3, enc4;
            var i = 0;
            input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
            while (i < input.length) {
                enc1 = _keyStr.indexOf(input.charAt(i++));
                enc2 = _keyStr.indexOf(input.charAt(i++));
                enc3 = _keyStr.indexOf(input.charAt(i++));
                enc4 = _keyStr.indexOf(input.charAt(i++));
                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;
                output = output + String.fromCharCode(chr1);
                if (enc3 != 64) {
                    output = output + String.fromCharCode(chr2);
                }
                if (enc4 != 64) {
                    output = output + String.fromCharCode(chr3);
                }
            }
            output = _utf8_decode(output);
            return output;
        }

        // private method for UTF-8 encoding  
        _utf8_encode = function (string) {
            string = string.replace(/\r\n/g, "\n");
            var utftext = "";
            for (var n = 0; n < string.length; n++) {
                var c = string.charCodeAt(n);
                if (c < 128) {
                    utftext += String.fromCharCode(c);
                } else if ((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                } else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }

            }
            return utftext;
        }

        // private method for UTF-8 decoding  
        _utf8_decode = function (utftext) {
            var string = "";
            var i = 0;
            var c = c1 = c2 = 0;
            while (i < utftext.length) {
                c = utftext.charCodeAt(i);
                if (c < 128) {
                    string += String.fromCharCode(c);
                    i++;
                } else if ((c > 191) && (c < 224)) {
                    c2 = utftext.charCodeAt(i + 1);
                    string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                    i += 2;
                } else {
                    c2 = utftext.charCodeAt(i + 1);
                    c3 = utftext.charCodeAt(i + 2);
                    string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                    i += 3;
                }
            }
            return string;
        }
    }


</script>

    <style>
        #iframeBox {
            position: absolute;
            /* height: calc(100%); */
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
        }

        #fream {
            position: absolute;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .layui-layout-admin .layui-body {
            top: 60px;
            bottom: 0;
        }

        .hr-black {
            background-color: #222;
        }

        .layui-layout-admin .layui-logo {
            line-height: 3.4em;
        }

        .layui-layout-admin .layui-side {
            top: 3.4em;

        }

        .layui-nav-tree .layui-nav-item a {
            height: 3.7em;
            line-height: 3.7em;
        }

        .layui-layout-admin .layui-header {
            background-color: #2a2a2a;
            height: 3.7em;

        }

        .layui-nav .layui-nav-item {
            height: 3.7em;
            line-height: 3.7em;
        }

        .layui-layout-admin .layui-header * {
            color: #ffffff;
        }

        .layui-bg-black {
            background-color: #2a2a2a!important;
        }

        .layui-nav {
            border-top: solid 1px #222;
            background-color: #2a2a2a;
            color: #fff;
        }

        .layui-nav-tree .layui-nav-child dd.layui-this,
        .layui-nav-tree .layui-nav-child dd.layui-this a,
        .layui-nav-tree .layui-this,
        .layui-nav-tree .layui-this>a,
        .layui-nav-tree .layui-this>a:hover {
            background-color: #ddd;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">微商城</div>
            <!-- 头部区域（可配合layui已有的水平导航） -->

            <ul class="layui-nav layui-layout-right">


                <li class="layui-nav-item">
                    <a href="javascript:;" data-src='Config/showList'>当前账户：<?php echo (session('admin_id')); ?></a>
                </li>
                <li class="layui-nav-item">
                    <a href="<?php echo U('Login/sinOut');?>">退出登录</a>
                </li>
            </ul>
        </div>

        <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item">
                        <a href="javascript:;" data-src='Goods/showList'>商品管理</a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" data-src='Brand/showList'>品牌管理</a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" data-src='Nav/showList'>导航管理</a>
                    </li>
                    <hr class="hr-black">
                    <li class="layui-nav-item">
                        <a href="javascript:;" data-src='Order/showList'>订单管理</a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" data-src='Config/showList'>账号设置</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="layui-body">
            <!-- 内容主体区域 -->
            <div id="iframeBox">
                <!-- <iframe src="/wShop/index.php/Admin/Index/home" id="fream" frameborder="0"></iframe> -->
                <!-- <iframe src="Exam/showList" id="fream" frameborder="0"></iframe> -->
                <iframe src="" id="fream" frameborder="0"></iframe>
            </div>
        </div>


    </div>


    <script>



        layui.use('element', function () {
            var element = layui.element;
        });
        $(function () {



            if ('<?php echo ($admin_url); ?>' != null && '<?php echo ($admin_url); ?>' != '') {
                $('#fream').attr('src', '<?php echo ($admin_url); ?>');
            }

            $('.layui-nav-item').each(function (index) {
                $(this).attr('id', 'item' + index);
            })

            // w(localStorage.item_id);
            $(localStorage.item_id).addClass('layui-this');


            $(document).on('click', 'a[href="javascript:;" ]', function () {
                var index = layer.load(1); //加载等待层

                localStorage.item_id = '#' + $(this).parents('.layui-nav-item').attr('id');

                if (!($(this).attr('data-src') == null)) {

                    $.post('', {
                        url: $(this).attr('data-src')
                    }, function (date) {
                        $('#fream').attr('src', date);
                        layer.close(index);
                    })
                }

            })

        });


        (function () {
            var eventName = 'click';
            var el = '#setUser';
            var fun = function (event) {
                var $this = $(this);

                //例子2
                layer.prompt({
                    value: '123123',
                    title: '请输入新密码',
                }, function (value, index, elem) {



                    var url = '/wShop/index.php/Admin/Config/setPwd';
                    var obj = {
                        admin_id: "<?php echo (session('admin_id')); ?>",
                        admin_pwd: value
                    };
                    var fun = function (res) {
                        try {
                            res = JSON.parse(res);
                        } catch (error) {
                            //转换错误
                            layer.msg('修改失败1');
                            return
                        }

                        if (res.res > 0) {

                            layer.msg('修改成功');
                            var url = "<?php echo U('Login/sinOut');?>";
                            window.location.href = url;


                        } else {
                            layer.msg('修改失败2');
                        }

                    };
                    $.post(url, obj, fun);




                });

            }

            $(document).on(eventName, el, fun);

        }());



    </script>
</body>

</html>