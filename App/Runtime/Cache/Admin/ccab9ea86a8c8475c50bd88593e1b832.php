<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>批量上传商品</title>
    <link rel="stylesheet" href="/wShop/Public/vendor/bootstrap4/css/bootstrap.min.css">
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
        body {
            background-color: rgb(38, 38, 38);
            padding-top: 30px;
        }

        pre {
            color: #ccc;
            border: solid 3px #ccc;
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
        }

        .table {
            text-overflow: ellipsis;
            white-space: nowrap;

        }

        .table tr td,
        .table tr th {
            vertical-align: middle;
        }

        .table tr td .vertical-top {
            vertical-align: top;
        }

        .progress-bar {
            transition: all 0.3s;
        }

        #loadBox {
            display: none;
            z-index: 9999;
            /* position: fixed; */
            top: 0;
            width: 100%;
        }

        #table {
            position: relative;
        }

        .arr-item {
            display: inline-block;
            margin: 0 5px;
        }

        .hover-img {
            max-width: 500px;
            border-radius: 5px;
        }

        [data-mtpis] {
            cursor: pointer;
            transition: all 0.3s;
        }

        [data-mtpis]:hover {
            background-color: #ffc107;
        }

        #upCSV {
            transition: all 0.3s;
            position: relative;
            border: dotted 3px #777;
            border-radius: 10px;
            margin: 10px;
            color: #777;
            text-align: center;
            vertical-align: middle;
            font-size: 50px;
            padding: 50px 0;

        }

        #upCSV.drag {
            /* background-color: #777777; */
        }

        .sk-spinner-pulse.sk-spinner {
            width: 40px;
            height: 40px;
            margin: 0 auto;
            background-color: #777;
            border-radius: 100%;
            -webkit-animation: sk-pulseScaleOut 1s infinite ease-in-out;
            animation: sk-pulseScaleOut 1s infinite ease-in-out;
        }

        .sk-spinner-double-bounce .sk-double-bounce1,
        .sk-spinner-double-bounce .sk-double-bounce2 {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #777;
            opacity: 0.6;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-animation: sk-doubleBounce 2s infinite ease-in-out;
            animation: sk-doubleBounce 2s infinite ease-in-out;
        }
    </style>
</head>

<body class="">

    <!-- 
    <button type="button" class="layui-btn" id="upCSV">
        <i class="layui-icon">&#xe67c;</i>拖拽文件或点击上传CSV文件
    </button> -->


    <div id="upCSV" draggable="true">
        <span id="upCSV_title">拖拽文件或点击上传CSV文</span>
        <div class="" id="sk">
            <div class="sk-double-bounce1"></div>
            <div class="sk-double-bounce2"></div>
        </div>
        <button class="layui-btn" id="ok" style="display: none">确认无误，开始上传</button>
    </div>
    <div class="table-responsive" id="table">
        <div class="layui-progress layui-progress-big" id="loadBox" lay-filter="demo" lay-showPercent="true">
            <div class="layui-progress-bar  layui-bg-orange" id="load" lay-percent="50%"></div>
        </div>
        <table id="app" class="table table-bordered table-striped table-hover table-dark table-sm">

            <thead class="thead">
                <tr>
                    <!-- <th v-for='(item,index) in th'>{{index}}:{{item}}</th> -->
                    <th>商品标题</th>
                    <th>价格</th>
                    <th>品牌名</th>
                    <th>一级分类名</th>
                    <th>二级分类名</th>
                    <th>商品头像地址</th>
                    <th>颜色</th>
                    <th>大小</th>
                    <th>尺寸</th>
                    <th>货号</th>
                    <th>商品详情页顶部大图</th>
                    <th>详情文本</th>
                    <th>详情图片</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='(item,index) in tr'>

                    <td v-for='(td,i) in item' class="">


                        <div class="arr-item-box" v-if='i==5'>
                            <span class="badge badge-danger" :data-mtpis='"<img class=\"hover-img\" src=\"/wShop/Public/upload/goods/"+td+"\"/>"'>{{td}}</span>
                        </div>
                        <div class="arr-item-box" v-else-if='i==10'>
                            <span class="badge badge-danger" :data-mtpis='"<img class=\"hover-img\" src=\"/wShop/Public/upload/goods/"+td+"\"/>"'>
                                {{td}}
                            </span>
                        </div>
                        <div class="arr-item-box" v-else-if='i==6'>
                            <div class='arr-item' v-for='(color,j) in td'>
                                <span class="badge badge-dark">{{color}}</span>
                            </div>
                        </div>
                        <div class="arr-item-box" v-else-if='i==7'>
                            <div class='arr-item' v-for='(size,j) in td'>
                                <span class="badge badge-warning">{{size}}</span>
                            </div>
                        </div>
                        <div class="arr-item-box" v-else-if='i==8'>
                            <div class='arr-item' v-for='(size2,j) in td'>
                                <span class="badge badge-secondary">{{size2}}</span>
                            </div>
                        </div>
                        <div class="arr-item-box" v-else-if='i==12'>
                            <div class='arr-item' v-for='(info_img,j) in td'>
                                <span class="badge badge-danger" :data-mtpis='"<img class=\"hover-img\" src=\"/wShop/Public/upload/goods/"+info_img+"\" />"'>{{info_img}}</span>
                            </div>
                        </div>
                        <span v-else>{{td}}</span>

                    </td>


                </tr>
            </tbody>

        </table>
    </div>

    <script rel="stylesheet" href="/wShop/Public/vendor/bootstrap4/js/bootstrap.min.js"></script>



    <script src='http://anthonyterrien.com/demo/knob/jquery.knob.min.js'></script>

    <script src="/wShop/Public/Admin/dist/batchUpload/batchUpload.js"></script>

    <script>

        config.controller = '/wShop/index.php/Admin/Goods';
        config.root = '/wShop';
        config.use = '/wShop/index.php/Admin/use';

    </script>

</body>

</html>