<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>【<?php echo ($brand["brand_title"]); ?>】的分类管理</title>

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

    <link href="/wShop/Public/vendor/bootstrap4/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/wShop/Public/Admin/dist/component/class/class.css">

    <style>
        body {
            padding: 15px
        }
    </style>

</head>

<body>

    <h3>品牌：【<?php echo ($brand["brand_title"]); ?>】的分类管理</h3>

    <div class="checkbox checkbox-primary">
        <input id="checkbox2" type="checkbox" checked="">
        <label for="checkbox2">
            Primary
        </label>
    </div>
    <div class="class-tool">

        <div class="class-tool-item add" data-type='1'>
            添加一级分类
        </div>
        <div class="class-tool-item add" data-type='2'>
            添加二级分类
        </div>
    </div>

    <!-- <div class="tool" id="tool">
        <div class="tool-item">
            <span class="fa fa-edit"></span>
            <span>编辑</span>
        </div>
        <div class="tool-item">
            <span class="fa fa-remove"></span>
            <span>删除</span>
        </div>
    </div> -->

    <div class="class-box">

        <div class="class-left" id="class1App">
            <ul>
                <li v-for='(item,index) in items' :key='item.class_id' @click='showClass2(item.class_id)'>
                    {{item.class_title}}
                    <div class="tool" :data-level='item.level'>
                        <div class="tool-item" @click='edit(item.class_id,index)'>
                            <span class="fa fa-edit"></span>
                            <span>编辑</span>
                        </div>
                        <div class="tool-item" @click='del(item.class_id,index)'>
                            <span class="fa fa-remove"></span>
                            <span>删除</span>
                        </div>
                    </div>
                </li>
                <!-- <li>b
                    <div class="tool">
                        <div class="tool-item">
                            <span class="fa fa-edit"></span>
                            <span>编辑</span>
                        </div>
                        <div class="tool-item">
                            <span class="fa fa-remove"></span>
                            <span>删除</span>
                        </div>
                    </div>
                </li> -->
            </ul>
        </div>
        <div class="class-right" id="class2App">
            <ul>
                <li v-for='(item,index) in items' :key='item.class_id'>
                    {{item.class_title}}
                    <div class="tool" :data-level='item.level'>
                        <div class="tool-item" @click='edit(item.class_id,index)'>
                            <span class="fa fa-edit"></span>
                            <span>编辑</span>
                        </div>
                        <div class="tool-item" @click='del(item.class_id,index)'>
                            <span class="fa fa-remove"></span>
                            <span>删除</span>
                        </div>
                    </div>
                </li>

                <!-- <li>sadf
                    <div class="tool">
                        <div class="tool-item">
                            <span class="fa fa-edit"></span>
                            <span>编辑</span>
                        </div>
                        <div class="tool-item">
                            <span class="fa fa-remove"></span>
                            <span>删除</span>
                        </div>
                    </div>
                </li>
            </ul> -->
        </div>



    </div>

    <script src="/wShop/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="/wShop/Public/vendor/bootstrap4/js/popper.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/wShop/Public/vendor/bootstrap4/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

    <script src='/wShop/Public/Admin/dist/component/class/class.js'></script>
    <script>
        config.ip = '/wShop/index.php/Admin/Use';
        config.brand_id = '<?php echo ($brand["brand_id"]); ?>';
        class1App.getList();

        $(function ($) {

            (function () {
                //添加分类
                var eventName = 'click';
                var el = '.add';
                var fun = function (event) {
                    var $this = $(this);
                    var type = $this.attr('data-type');
                    var super_id = null;

                    if (type == '2') {
                        if (class1App.activeClass_id == null || class1App.activeClass_id == '') {
                            layer.msg('必须先选择一个一级分类才能添加二级分类！', {
                                anim: 6
                            });
                            return;
                        }
                        super_id = class1App.activeClass_id;
                    }

                    //添加多个
                    layer.prompt({
                        formType: 2,
                        title: '添加类别，换行可添加多个',
                        area: ['600px', '350px']
                    }, function (value, prompt, elem) {
                        //处理输入的值

                        var arr = strToArr(value, '\n', function (i, arr, element) {

                            var item = {};
                            item.class_title = element;
                            item.level = type;
                            item.brand_id = '<?php echo ($brand["brand_id"]); ?>';
                            item.super_id = super_id;
                            item.sort = i;
                            return item;

                        });
                        //重复检查
                        if (type == '1') {
                            //检查一级分类
                            //先检查输入的内容是否重复
                            for (var i = 0; i < arr.length; i++) {
                                var item_i = arr[i];
                                var title_i = item_i.class_title;

                                for (let j = 0; j < arr.length; j++) {
                                    var item_j = arr[j];
                                    var title_j = item_j.class_title;
                                    if (i != j) {
                                        if (title_i == title_j) {
                                            layer.msg('一级分类:【' + title_i + '】检测到重名！请修改后重试。');
                                            return;
                                        }
                                    }
                                }
                            }
                        }


                        //执行服务器检查

                        (function () {

                            var url = '/wShop/index.php/Admin/use/getList';
                            var obj = {
                                table: 'class',
                                where: {
                                    brand_id: config.brand_id,
                                    level: type
                                }
                            };
                            if (type == '2') {
                                //如果是二级分类，就得让一级分类当做条件
                                obj.where.super_id = class1App.activeClass_id;
                            }

                            var fun = function (res) {

                                try {
                                    res = JSON.parse(res);
                                } catch (error) {
                                    //转换错误
                                    return
                                }


                                if (res.res > 0) {
                                    //有数据，执行查找
                                    //先检查输入的内容是否重复
                                    for (var i = 0; i < res.msg.length; i++) {
                                        var item_i = res.msg[i];
                                        var title_i = item_i.class_title;
                                        for (let j = 0; j < arr.length; j++) {
                                            var item_j = arr[j];
                                            var title_j = item_j.class_title;
                                            if (title_i == title_j) {
                                                if (type == '1') {
                                                    layer.msg('一级分类:【' + title_i + '】已存在！请修改后重试。');
                                                } else {
                                                    layer.msg('二级分类:【' + title_i + '】已存在！请修改后重试。');
                                                }

                                                return;
                                            }
                                        }
                                    }
                                }
                                // 到这就是没有重复的
                                addAll({
                                    table: 'class',
                                    add: arr,
                                }).yes(function (res) {
                                    //转换正确
                                    if (res.res > 0) {
                                        //添加成功了
                                        layer.msg('添加成功~');
                                        layer.close(prompt);

                                        if (type == '1') {
                                            class1App.getList();
                                        } else {
                                            class1App.showClass2(class1App.activeClass_id);
                                        }

                                    } else {
                                        //添加失败了
                                        layer.msg('添加失败', {
                                            anim: 6
                                        });
                                    }

                                }).no(function (res) {
                                    w(res);
                                    //转换失败
                                    //传回来的不是json
                                    layer.msg('异步接口出错！', {
                                        anim: 6
                                    });
                                });
                            };
                            $.get(url, obj, fun);
                        }());



                    });
                }
                $(document).on(eventName, el, fun);
            }());
        })



    </script>


</body>

</html>