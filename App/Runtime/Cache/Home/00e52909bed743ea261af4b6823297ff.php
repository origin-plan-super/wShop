<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>测试</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">

    <style>
        .del,
        .edit {
            color: #f00;
            cursor: pointer;
        }

        .edit {
            color: #0f0;
        }

        .del:hover,
        .edit:hover {
            text-decoration: underline;
        }

        kbd {
            cursor: pointer;
        }
    </style>

</head>

<body>

    <div class="container">



        <div id="testApp">




            <div class="form-group">
                <input type="text" class="form-control" v-model='new_content'>
            </div>



            <!-- <button type="button" class="btn btn-dark" @click='save()'>保存</button> -->
            <button type="button" class="btn btn-success" @click='add()'>添加</button>
            <button type="button" class="btn btn-info" @click='getList()'>刷新</button>
            <button type="button" class="btn btn-danger" @click='delAll()'>删除选中</button>

            <div class="text-center">
                <p v-for='(item,index) in items'>
                    <span class="del" @click='del(item.test_id)'>删除</span>
                    <span class="edit" @click='saveField(item.test_id)'>编辑</span>

                    <kbd @click='getOne(item.test_id)'>
                        【{{item.test_id}}】：{{item.test_content}} —— 价格是：【{{item.money}}$】
                    </kbd>

                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" v-model='dels' :value="item.test_id">选择
                    </label>
                </p>

            </div>
        </div>
        <div id="test"></div>
    </div>



    <script data-main="js/main" src="js/require.js"></script>

    <script>

        require.config({
            paths: {
                "index": "Public/dist/component/index/index",
            }
        })
        require(["index"]);

    </script>
</body>

</html>