<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>订单管理</title>
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

        .fk {
            height: 300px;
            width: 100%;
            /* background-color: #ddd; */
            border-radius: 10px;
            border: solid 3px #eee;
            margin: 100px 0;
            padding: 30px;
            display: none;
        }

        .nav-box {
            padding: 20px;
        }
    </style>

</head>

<body>
    <fieldset class="layui-elem-field layui-field-title">
        <legend>订单管理</legend>
    </fieldset>


    <div class="fk" id="xz_nav">
        <div class="layui-form nav-box" id="navApp">

            <input type="checkbox" :title="item.nav_title">

        </div>

    </div>


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

            <button class="layui-btn layui-btn-sm" id="removeAll">
                <i class="layui-icon">&#xe640;</i>批量删除
            </button>
        </div>


    </div>

    <table id="table" lay-filter="table_filter"></table>


    <script type="text/html" id="bar1">
        <a class="layui-btn layui-btn-sm" lay-event="open">查看</a>
        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
    </script>


    <script type="text/html" id="bar_state">


        
                {{# if(d.state == 0){  }}
                <!-- <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="up"> -->
                待付款
                <!-- </a> -->
                {{# } }}

                {{# if(d.state == 1){  }}
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="fh">
                去发货
                </a>
                <!-- order_on -->
                {{# } }}

                {{# if(d.state == 2){  }}
                <a class="layui-btn layui-btn-xs" lay-event="fhok">
                已发货
                </a>
                {{# } }}

                {{# if(d.state == 3){  }}
                <!-- <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="up"> -->
                交易成功
                <!-- </a> -->
                {{# } }}

                {{# if(d.state == 4){  }}
                <a class="layui-btn layui-btn-warm layui-btn-xs" href='/wShop/index.php/Admin/Order/sh/order_id/{{d.order_id}}' target='_black' >
                售后处理
                </a>
                {{# } }}

                {{# if(d.state == 5){  }}
                售后已处理
                {{# } }}

                    
    </script>



    <script>


        var tableIns;
        var table;
        var active_order_id;
        layui.use(['table', 'form'], function () {
            table = layui.table
                , form = layui.form;
            //第一个实例
            tableIns = table.render({
                id: 'table'
                , elem: '#table'
                , url: '/wShop/index.php/Admin/Order/getList' //数据接口
                , where: {
                    table: 'order',
                }
                , order: 'add_time desc'
                , response: {
                    statusCode: 1 //成功的状态码，默认：0
                }
                , page: true //开启分页
                , limit: localStorage.limit == null ? 20 : localStorage.limit
                // , limits: [5, 10]
                , cols: [[ //表头
                    { type: 'checkbox', width: 50, fixed: 'lfet' }
                    , { field: 'order_id', title: '商品id', width: 100 }
                    , { field: 'openid', edit: 'text', title: '用户ID（openid）', width: 200 }
                    , { field: 'user_name', title: '用户名', width: 150 }
                    , { field: 'money', title: '订单总价', edit: 'text', width: 130, sort: true }
                    , { field: 'add_time', title: '添加时间', width: 200, sort: true }
                    , { field: 'edit_time', title: '最后修改时间', width: 200, sort: true }
                    , { field: 'state', fixed: 'right', width: 100, align: 'center', title: '状态', toolbar: '#bar_state' } //这里的toolbar值是模板元素的选择器
                    , { fixed: 'right', width: 150, align: 'center', title: '操作', toolbar: '#bar1' } //这里的toolbar值是模板元素的选择器
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
                            table: 'order',
                            id: data.order_id,
                        };

                        del(delObj, function () {
                            obj.del();
                        })

                    });
                }

                if (layEvent === 'fh') { //去发货
                    var on;
                    var gs;
                    //例子2
                    layer.prompt({
                        formType: 0,
                        title: '请输入快递单号',
                    }, function (value, _on, elem) {
                        on = value;
                        layer.close(_on);

                        layer.prompt({
                            formType: 0,
                            title: '请输入快递公司',
                        }, function (value, _gs, elem) {
                            gs = value;
                            layer.close(_gs);

                            (function () {

                                var url = '/wShop/index.php/Admin/Order/saveOn';
                                var obj = {
                                    order_id: data.order_id,
                                    order_gs: gs,
                                    order_on: on
                                };
                                var fun = function (res) {
                                    w(res);
                                    try {
                                        res = JSON.parse(res);
                                    } catch (error) {
                                        //转换错误
                                        return
                                    }
                                    if (res.res > 0) {
                                        layer.msg('操作成功！');
                                        tableIns.reload();

                                    } else {
                                        layer.msg('失败！');
                                    }

                                };
                                $.post(url, obj, fun);

                            }());

                        });
                    });


                }

                if (layEvent === 'fhok') {

                    layer.confirm('【单号】' + data.order_on + '<br/>【公司】' + data.order_gs, {
                        title: '物流信息',
                        btn: ['确定', '修改']
                    }, function (index, layero) {
                        //按钮【按钮一】的回调

                        layer.close(index);
                    }, function () {
                        //按钮【按钮二】的回调
                        w('xxx')
                        layer.prompt({
                            formType: 0,
                            title: '请输入快递单号',
                        }, function (value, _on, elem) {
                            on = value;
                            layer.close(_on);

                            layer.prompt({
                                formType: 0,
                                title: '请输入快递公司',
                            }, function (value, _gs, elem) {
                                gs = value;
                                layer.close(_gs);

                                (function () {

                                    var url = '/wShop/index.php/Admin/Order/saveOn';
                                    var obj = {
                                        order_id: data.order_id,
                                        order_gs: gs,
                                        order_on: on
                                    };
                                    var fun = function (res) {
                                        w(res);
                                        try {
                                            res = JSON.parse(res);
                                        } catch (error) {
                                            //转换错误
                                            return
                                        }
                                        if (res.res > 0) {
                                            layer.msg('操作成功！');
                                            tableIns.reload();

                                        } else {
                                            layer.msg('失败！');
                                        }

                                    };
                                    $.post(url, obj, fun);

                                }());

                            });
                        });


                    });


                }

                if (layEvent === 'open') { //编辑

                    window.open('/wShop/index.php/Admin/Order/show/order_id/' + data.order_id);
                }

            });

            form.on('checkbox(is_up)', function (data) {
                var id = data.value


                if (data.elem.checked) {
                    //选中
                    (function () {
                        var url = '/wShop/index.php/Admin/use/add';
                        var obj = {
                            table: 'up',
                            add: {
                                order_id: active_order_id,
                                nav_id: id
                            }
                        };
                        var fun = function (res) {

                            try {
                                res = JSON.parse(res);
                            } catch (error) {
                                //转换错误
                                return
                            }

                        };
                        $.post(url, obj, fun);
                    }());

                } else {
                    //取消
                    (function () {
                        var url = '/wShop/index.php/Admin/use/del';
                        var obj = {
                            table: 'up',
                            where: {
                                order_id: active_order_id,
                                nav_id: id
                            }
                        };
                        var fun = function (res) {

                            try {
                                res = JSON.parse(res);
                            } catch (error) {
                                //转换错误
                                return
                            }

                        };
                        $.post(url, obj, fun);
                    }());

                }

            });

            //监听复选框操作
            form.on('checkbox(is_show)', function (obj) {

                // this.value = false;

                var id = this.value;

                // var load = layer.load(2);
                var is_show = obj.elem.checked ? 1 : 0;

                var save = {
                    table: 'order',
                    id: id,
                    save: {
                        is_show: is_show
                    }
                };
                saveInfo(save, function (res) {
                    // layer.close(load);
                    if (res.res > 0) {
                        //修改成功

                        // var title = obj.elem.checked ? '已推荐' : '取消推荐';
                        // layer.tips('推荐：' + title, obj.othis);

                    }

                    if (res.res <= 0) {
                        layer.msg('推荐失败！请重试或者联系管理员！' + res.msg, {
                            anim: 6
                        });
                    }
                });

            });


            /**
             * 监听单元格编辑
            */
            table.on('edit(table_filter)', function (obj) { //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
                console.log(obj.value); //得到修改后的值
                console.log(obj.field); //当前编辑的字段名
                console.log(obj.data); //所在行的所有相关数据


                var save = {
                    table: 'order',
                    id: obj.data.order_id,
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
            var key_where = 'order_id|money|order_title';
            //执行重载
            tableIns.reload({
                page: {
                    curr: 1 //重新从第 1 页s开始
                }
                , where: {
                    table: 'order',
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

        $('#add').on('click', function () {


            window.open('/wShop/index.php/Admin/Order/add');
            return;

            layer.open({
                type: 2,
                title: '新增优惠码',
                shadeClose: true,
                shade: 0.3,
                maxmin: true, //开启最大化最小化按钮
                area: ['893px', '600px'],
                content: '/wShop/index.php/Admin/Order/add'
                , cancel: function (index, layero) {
                    tableIns.reload();
                }

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

            layer.confirm('确定删除这些商品？', function (index) {

                var id = [];
                for (var i = 0; i < o.data.length; i++) {
                    id[i] = o.data[i].order_id;
                }

                var obj = {
                    table: 'order',
                    id: id
                };

                delAll(obj, function (params) {
                    tableIns.reload();
                });

            });

        });

        /**
        * 批量上下架
        */
        $(document).on('click', '.is_show_all', function () {
            var type = $(this).attr('data-type');
            var o = table.checkStatus('table');
            if (o.data.length <= 0) {
                return;
            }
            var id = [];
            for (var i = 0; i < o.data.length; i++) {
                id[i] = o.data[i].order_id;
            }
            (function () {
                var url = '/wShop/index.php/Admin/Use/saveAll';
                var obj = {
                    table: 'order',
                    id: id,
                    save: {
                        is_show: type
                    }
                };
                var fun = function (res) {
                    try {
                        res = JSON.parse(res);
                    } catch (error) {
                        //转换错误
                        layer.msg('异步接口错误！');
                        return
                    }
                    if (res.res >= 0) {
                        layer.msg('操作成功！');
                        tableIns.reload();

                    } else {
                        layer.msg('操作失败！');
                    }
                };
                $.post(url, obj, fun);
            }());
        });


    </script>
</body>

</html>