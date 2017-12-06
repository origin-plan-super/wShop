<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新增商品</title>
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
    <link rel="stylesheet" type="text/css" href="/wShop/Public/vendor/umeditor/themes/default/css/umeditor.css" />
    <style>
        body {
            padding: 15px
        }

        .goods-img {
            max-width: 300px;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <fieldset class="layui-elem-field layui-field-title">
        <legend>新增商品</legend>
    </fieldset>

    <form class="layui-form" action="/wShop/index.php/Admin/Use/add" method="post">

        <div class="layui-form-item">
            <div class="layui-block">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-inline" style="width: 500px;">
                    <input type="text" name="goods_title" placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>

        <!--  -->

        <div class="layui-form-item">
            <div class="layui-block">
                <label class="layui-form-label">价格</label>
                <div class="layui-input-inline">
                    <input type="number" name="money" placeholder="￥" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <!--  -->

        <div class="layui-form-item">
            <div class="layui-block">
                <label class="layui-form-label">商品头像</label>
                <div class="layui-input-block">
                    <div id="headImgApp">
                        <img :src="img" class="goods-img">
                        <input type="hidden" v-model='src' name="head_img">
                        <p>

                            <button type='button' class="layui-btn  layui-btn-danger" v-if='remove'>
                                <i class="layui-icon">&#x1006;</i> 删除
                            </button>
                            <button type='button' class="layui-btn" id="up_head_img">
                                <i class="layui-icon">&#xe67c;</i>{{title}}
                            </button>

                        </p>

                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="layui-form-item">
            <div class="layui-block">
                <label class="layui-form-label">详情页顶部大图</label>
                <div class="layui-input-block">

                    <div id="infoHeadImgApp">
                        <img :src="img" class="goods-img">
                        <input type="hidden" v-model='src' name="info_head_img">


                        <p>

                            <button type='button' class="layui-btn  layui-btn-danger" v-if='remove'>
                                <i class="layui-icon">&#x1006;</i> 删除
                            </button>
                            <button type='button' class="layui-btn" id="up_info_head_img">
                                <i class="layui-icon">&#xe67c;</i>{{title}}
                            </button>


                        </p>

                    </div>


                </div>
            </div>
        </div>
        <!--  -->

        <div class="layui-form-item">
            <div class="layui-block">
                <label class="layui-form-label">选择品牌</label>
                <div class="layui-input-inline">
                    <select name="brand_id" lay-verify="required" lay-filter="se_brand" lay-search id="se_brand">
                        <option value="">商品品牌</option>
                    </select>
                </div>
            </div>
        </div>

        <!--  -->
        <!--  -->
        <div class="layui-form-item">
            <div class="layui-block">
                <label class="layui-form-label">颜色</label>
                <div class="layui-input-block" id="colorApp">
                    <input type="hidden" name="color" v-model='msg'>

                    <div class="layui-btn-group" v-for='(item,index) in items'>
                        <button type='button' class="layui-btn layui-btn-primary layui-btn-sm">{{item}}</button>
                        <button type='button' @click='del(index,item)' class="layui-btn layui-btn-primary remove-item layui-btn-sm">
                            <i class="layui-icon">&#x1006;</i>
                        </button>
                    </div>

                    <button type='button' @click='add()' class="layui-btn layui-btn-primary add-item layui-btn-sm">
                        <i class="layui-icon">&#xe654;</i>
                    </button>
                </div>
            </div>
        </div>

        <!--  -->
        <div class="layui-form-item">
            <div class="layui-block">
                <label class="layui-form-label">大小</label>
                <div class="layui-input-block" id="sizeApp">

                    <input type="hidden" name="size" v-model='msg'>
                    <div class="layui-btn-group" v-for='(item,index) in items'>
                        <button type='button' class="layui-btn layui-btn-primary layui-btn-sm">{{item}}</button>
                        <button type='button' @click='del(index,item)' class="layui-btn layui-btn-primary remove-item layui-btn-sm">
                            <i class="layui-icon">&#x1006;</i>
                        </button>
                    </div>
                    <button type='button' @click='add()' class="layui-btn layui-btn-primary add-item layui-btn-sm">
                        <i class="layui-icon">&#xe654;</i>
                    </button>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="layui-form-item">
            <div class="layui-block">
                <label class="layui-form-label">尺码</label>
                <div class="layui-input-block" id="size2App">
                    <input type="hidden" name="size2" v-model='msg'>
                    <div class="layui-btn-group" v-for='(item,index) in items'>
                        <button type='button' class="layui-btn layui-btn-primary layui-btn-sm">{{item}}</button>
                        <button type='button' @click='del(index,item)' class="layui-btn layui-btn-primary remove-item layui-btn-sm">
                            <i class="layui-icon">&#x1006;</i>
                        </button>
                    </div>

                    <button type='button' @click='add()' class="layui-btn layui-btn-primary add-item layui-btn-sm">
                        <i class="layui-icon">&#xe654;</i>
                    </button>

                </div>
            </div>
        </div>

        <!--  -->
        <div class="layui-form-item">
            <label class="layui-form-label">选择分类</label>
            <div class="layui-input-inline">
                <select name="class_id_1" lay-verify="required" lay-filter="se_class_1" lay-search id="se_class_1">
                    <option value="">一级分类</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="class_id_2" lay-verify="required" lay-filter="se_class_2" id="se_class_2">
                    <option value="">二级分类</option>
                </select>
            </div>
        </div>

        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">详情</label>
            <div class="layui-input-block">
                <div class="layui-col-md12" style="z-index: 1;">
                    <script id="container" name="info" style="width: 100%;" type="text/plain" lay-verify='required'></script>
                </div>
            </div>
        </div>

        <!--  -->

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="*">添加</button>
            </div>
        </div>



    </form>

    <!-- 引入 etpl -->
    <script src="/wShop/Public/vendor/umeditor/third-party/template.min.js" type="text/javascript" charset="utf-8"></script>
    <!-- 配置文件 -->
    <script src="/wShop/Public/vendor/umeditor/umeditor.config.js" type="text/javascript" charset="utf-8"></script>
    <!-- 编辑器源码文件 -->
    <script src="/wShop/Public/vendor/umeditor/umeditor.js" type="text/javascript" charset="utf-8"></script>
    <!-- 语言包文件 -->
    <script src="/wShop/Public/vendor/umeditor/lang/zh-cn/zh-cn.js" type="text/javascript" charset="utf-8"></script>

    <!--  -->
    <script src="/wShop/Public/dist/linkage/linkage.js" type="text/javascript" charset="utf-8"></script>
    <!---->
    <script>



        var headImgApp = new Vue({
            el: '#headImgApp',
            data: {
                img: '',
                src: '',
                // img: '/wShop/Public/Upload//goods/2017-12-04/5a24e3548531c.jpg',
                remove: false,
                title: '上传图片'
            }
        });

        var infoHeadImgApp = new Vue({
            el: '#infoHeadImgApp',
            data: {
                img: '',
                src: '',
                // img: '/wShop/Public/Upload//goods/2017-12-04/5a24e3548531c.jpg',
                remove: false,
                title: '上传图片'
            }
        });

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



        window.um = UM.getEditor('container', {
            /* 传入配置参数,可配参数列表看umeditor.config.js */
        });
        layui.use(['form', 'laydate', 'upload'], function () {
            var form = layui.form;
            var laydate = layui.laydate;
            var upload = layui.upload;

            //执行实例
            var uploadInst1 = upload.render({
                elem: '#up_head_img' //绑定元素
                , url: '/wShop/index.php/Admin/Use/upFile' //上传接口
                , data: {
                    'src': 'goods/'
                }
                , done: function (res) {
                    //上传完毕回调
                    w(res.data.src);

                    headImgApp.img = '/wShop/' + res.data.src;
                    headImgApp.src = res.data.src;
                    // headImgApp.remove = true;
                    headImgApp.title = '重新上传';
                }
                , error: function () {
                    //请求异常回调
                }
            });


            //执行实例
            var uploadInst2 = upload.render({
                elem: '#up_info_head_img' //绑定元素
                , url: '/wShop/index.php/Admin/Use/upFile' //上传接口
                , data: {
                    'src': 'goods/'
                }
                , done: function (res) {
                    //上传完毕回调
                    w(res);
                    infoHeadImgApp.img = '/wShop/' + res.data.src;
                    infoHeadImgApp.src = res.data.src;
                    // infoHeadImgApp.remove = true;
                    infoHeadImgApp.title = '重新上传';
                }
                , error: function () {
                    //请求异常回调
                }
            });




            url = '/wShop/index.php/Admin/Use/' + 'getList';

            (function () {

                var obj = {
                    table: ['brand', 'class', 'class as class2'],
                    where: {
                        brand: {
                            // 'brand_id': 'caf6566c20c93ac969e8dcbf2012c5fe'
                        },
                        class: {
                            'level': '1'
                        },
                        class2: {
                            'level': '2'
                        }
                    }
                };
                var fun = function (res) {

                    try {
                        res = JSON.parse(res);
                    } catch (error) {
                        //转换错误
                        return
                    }

                    var arr = [];

                    var count = 0;

                    for (var x in res.msg) {
                        arr[count] = res.msg[x];
                        count++;
                    }

                    linkage(arr, form);

                };
                $.get(url, obj, fun);

            }());


            form.on('submit(*)', function (data) {
                // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
                // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
                // console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}


                var index = layer.load(2);

                (function () {

                    var url = '/wShop/index.php/Admin/Use/add';
                    var obj = {
                        table: 'goods',
                        add: data.field
                    };

                    var fun = function (res) {

                        layer.close(index);
                        try {
                            res = JSON.parse(res);
                        } catch (error) {
                            //转换错误
                            return
                        }

                        if (res.res > 0) {
                            layer.msg('成功~');

                            //询问框
                            layer.confirm('添加成功~是否刷新页面？', {
                                btn: ['确定', '取消'] //按钮
                            }, function () {
                                window.location = window.location;
                            });


                        } else {
                            layer.msg('失败！' + res.msg);
                        }

                    };

                    $.post(url, obj, fun);

                }());


                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

        });

    </script>
</body>

</html>