// @ts-nocheck
require.config({
    paths: {
        "jquery": "Public/vendor/jquery/jquery",
        "vue": "Public/vendor/vue/vue",
        "layer": "Public/vendor/layer/layer",
        "bootstrap": "https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js",
        "popper": "https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"
    },
    shim: {

    }
});

require(["jquery"]);
require(["layer"], function (layer) {
    layer.config({
        path: 'Public/vendor/layer/' //layer.js所在的目录，可以是绝对目录，也可以是相对目录
    });
});

