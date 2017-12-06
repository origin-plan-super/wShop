<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>品牌管理</title>
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
            padding: 15px
        }
    </style>

</head>

<body>
    <fieldset class="layui-elem-field layui-field-title">
        <legend>品牌管理</legend>
    </fieldset>
    <div class="layui-row layui-form">
        <div class="layui-col-md4">
            <div class="layui-inline">
                <input class="layui-input" id="key" placeholder="搜索" autocomplete="off">
            </div>
            <button class="layui-btn" id="reload" data-type="reload">搜索</button>

        </div>

    </div>
    <div class="layui-row" style="padding-top:10px">

        <div class="layui-btn-group">
            <button class="layui-btn layui-btn-sm" id="add">
                <i class="layui-icon">&#xe654;</i>新增品牌
            </button>
            <button class="layui-btn layui-btn-sm" id="removeAll">
                <i class="layui-icon">&#xe640;</i>批量删除
            </button>
        </div>


    </div>

    <table id="table" lay-filter="table_filter"></table>


    <script type="text/html" id="bar1">
        <a class="layui-btn layui-btn-sm" lay-event="showClassList">管理分类</a>
        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
    </script>



    <script>
        var tableIns;
        var table;
        layui.use(['table', 'form'], function () {
            table = layui.table
                , form = layui.form;
            //第一个实例
            tableIns = table.render({
                id: 'table'
                , elem: '#table'
                , url: '/wShop/index.php/Admin/Use/getListWhere' //数据接口s
                , where: {
                    table: 'brand',
                }
                , response: {
                    statusCode: 1 //成功的状态码，默认：0
                }
                , page: true //开启分页
                , limit: localStorage.limit == null ? 30 : localStorage.limit
                // , limits: [5, 10]
                , cols: [[ //表头
                    { type: 'checkbox', width: 50, fixed: 'lfet' }
                    , { field: 'brand_id', title: 'id', width: 100 }
                    , { field: 'brand_title', title: '品牌名', width: 200, edit: 'text' }
                    , { field: 'add_time', title: '添加时间', width: 200, sort: true }
                    , { field: 'edit_time', title: '最后修改时间', width: 200, sort: true }
                    , { fixed: 'right', width: 200, align: 'center', title: '操作', toolbar: '#bar1' } //这里的toolbar值是模板元素的选择器
                ]]
            });


            //监听工具条
            table.on('tool(table_filter)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data; //获得当前行数据
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                var tr = obj.tr; //获得当前行 tr 的DOM对象

                if (layEvent === 'del') { //删除

                    layer.confirm('真的删除此条数据吗？', function (index) {
                        //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        //向服务端发送删除指令

                        var delObj = {
                            table: 'brand',
                            id: data.brand_id,
                            link_del: [
                                {
                                    table: 'class',
                                    where: {
                                        brand_id: data.brand_id,
                                    }
                                }
                            ]
                        };

                        del(delObj, function () {
                            obj.del();
                        })

                    });
                }

                if (layEvent === 'showClassList') { //管理分类

                    window.open('/wShop/index.php/Admin/Class/showList/brand_id/' + data.brand_id);

                }


                // 

            });



            /**
             * 监听单元格编辑
            */
            table.on('edit(table_filter)', function (obj) { //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
                console.log(obj.value); //得到修改后的值
                console.log(obj.field); //当前编辑的字段名
                console.log(obj.data); //所在行的所有相关数据  


                var save = {
                    table: 'brand',
                    id: obj.data.brand_id,
                    save: {}
                };
                save['save'][obj.field] = obj.value;
                saveInfo(save);

            });
        });

        /**
        数据搜索
        */
        $(document).on('click', '#reload', function () {

            var key = $('#key').val();
            var key_where = 'brand_id|brand_title';
            //执行重载
            tableIns.reload({
                page: {
                    curr: 1 //重新从第 1 页s开始
                }
                , where: {
                    table: 'brand',
                    key: key,
                    key_where: key_where
                }
                , done: function (res, curr, count) {
                    //如果是异步请求数据方式，res即为你接口返回的信息。
                    //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                    console.log(res);

                    //得到当前页码
                    console.log(curr);

                    //得到数据总量
                    console.log(count);
                }
            });

        });

        //新增
        $('#add').on('click', function () {
            layer.prompt({
                formType: 2,
                title: '添加品牌，换行可添加多个，品牌不能重名。',
                area: ['600px', '350px'] //自定义文本域宽高
            }, function (value, index, elem) {

                var load = layer.load(2);

                var arr = strToArr(value, '\n', 'brand_title');
                //重名检查
                for (var i = 0; i < arr.length; i++) {
                    var item_i = arr[i];

                    for (var j = 0; j < arr.length; j++) {
                        var item_j = arr[j];

                        if (j != i) {
                            if (item_i['brand_title'] == item_j['brand_title']) {
                                //检测到重名
                                layer.msg('品牌名：【' + item_i['brand_title'] + '】已存在，请修改后再操作！');
                                layer.close(load);
                                return;
                            }
                        }
                    }
                }

                //再从服务器取出，和服务器中的数据进行比对看看有没有重名的

                (function () {

                    var url = '/wShop/index.php/Admin/Use/getList';
                    var obj = {
                        table: 'brand'
                    };
                    var fun = function (res) {

                        try {
                            res = JSON.parse(res);
                        } catch (error) {
                            //转换错误
                            return
                        }
                        if (res.res > 0) {
                            //服务器有数据，进行判断
                            var brand_arr = res.msg;

                            for (var i = 0; i < arr.length; i++) {
                                var item_i = arr[i];

                                for (var j = 0; j < brand_arr.length; j++) {
                                    var item_j = brand_arr[j];

                                    if (item_i['brand_title'] == item_j['brand_title']) {
                                        //检测到重名
                                        w(item_i['brand_title']);
                                        w(item_j['brand_title']);
                                        layer.msg('品牌名：【' + item_i['brand_title'] + '】已存在，请修改后再操作！');
                                        layer.close(load);
                                        return;
                                    }
                                }
                            }
                            //能执行到这里代表本地没有重名并且服务器也没有重名
                            addBrnad(arr, load, index);
                        }
                    };
                    $.get(url, obj, fun);

                }());
            });
        });

        /**
         * 批量删除
         */
        $(document).on('click', '#removeAll', function () {
            // w('开始批量删除');
            var o = table.checkStatus('table');
            if (o.data.length <= 0) {
                return;
            }

            layer.confirm('确定删除这些数据？', function (index) {

                var id = [];
                for (var i = 0; i < o.data.length; i++) {
                    id[i] = o.data[i].brand_id;
                }


                var obj = {
                    table: 'brand',
                    id: id,
                    link_del: [
                        {
                            table: 'class',
                            where: {
                                brand_id: id,
                            }
                        }
                    ]
                };

                delAll(obj, function (params) {
                    tableIns.reload();

                });

            });

        });


        //添加品牌
        function addBrnad(arr, load, prompt) {

            (function () {

                var url = '/wShop/index.php/Admin/Use/addAll';
                var obj = {

                    table: 'brand',
                    add: arr

                };
                var fun = function (res) {

                    layer.close(load);
                    layer.close(prompt);

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

                        layer.msg('添加成功~');
                        tableIns.reload();

                    } else {
                        layer.msg('添加失败：' + res.msg);
                    }

                };
                $.post(url, obj, fun);
            }());

        }

    </script>
</body>

</html>