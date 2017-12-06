<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>全局分类管理</title>
    <!-- css -->
<link href="/wShop/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">
<link href="/wShop/Public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<!-- js -->
<script src="/wShop/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="/wShop/Public/vendor/vue/vue.js"></script>
<script src="/wShop/Public/vendor/layer/layer.js"></script>
<script src="/wShop/Public/vendor/layui/layui.js"></script>
<script src="/wShop/Public/Admin/dist/tool/tool.js"></script>

<script>

    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/, ' ');
    }

    function saveInfo(save) {
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
                arr[i] = f(i, arr, element);
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


    <div class="class-tool">

        <div class="class-tool-item" id="add1">
            添加一级分类
        </div>
        <div class="class-tool-item" id="add2">
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
        class1App.getList();


        $(function ($) {

            (function () {
                var eventName = 'click';
                var el = '#add1';
                var fun = function (event) {

                    var $this = $(this);



                    //添加多个
                    layer.prompt({
                        formType: 2,
                        title: '添加类别，换行可添加多个',
                        area: ['600px', '350px'] //自定义文本域宽高
                    }, function (value, index, elem) {

                        var arr = strToArr(value, '\n', 'class_title');

                        for (let i = 0; i < arr.length; i++) {
                            const element = arr[i];
                            arr[i].level = 1;
                        }
                        w(arr);

                        (function () {

                            var url = '/wShop/index.php/Admin/Use/addAll';
                            var obj = {

                                table: 'class',
                                add: arr,


                            };
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
                                    layer.msg('添加成功~');
                                    layer.close(index);

                                } else {
                                    layer.msg('添加失败：' + res.msg);
                                }

                            };
                            $.post(url, obj, fun);
                        }());

                    });
                }

                $(document).on(eventName, el, fun);

            }());

            (function () {
                var eventName = 'click';
                var el = '#add2';
                var fun = function (event) {


                    if (!class1App.activeClass_id) {

                        layer.msg('必须选择一个一级分类才能添加二级分类！', {
                            anim: 6
                        });
                        return;
                    }


                    var $this = $(this);

                    //添加多个
                    layer.prompt({
                        formType: 2,
                        title: '添加类别，换行可添加多个',
                        area: ['600px', '350px'] //自定义文本域宽高
                    }, function (value, index, elem) {

                        var arr = strToArr(value, '\n', 'class_title');

                        for (let i = 0; i < arr.length; i++) {
                            const element = arr[i];
                            arr[i].level = 2;
                            arr[i].super_id = class1App.activeClass_id;
                        }
                        w(arr);
                        (function () {

                            var url = '/wShop/index.php/Admin/Use/addAll';
                            var obj = {

                                table: 'class',
                                add: arr,
                            };
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
                                    layer.msg('添加成功~');
                                    layer.close(index);

                                    class1App.showClass2(class1App.activeClass_id);

                                } else {
                                    layer.msg('添加失败：' + res.msg);
                                }

                            };
                            $.post(url, obj, fun);
                        }());

                    });
                }

                $(document).on(eventName, el, fun);

            }());

        })



    </script>


</body>

</html>