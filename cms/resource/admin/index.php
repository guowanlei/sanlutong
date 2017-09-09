
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>后盾网 - HDCMS开源免费内容管理系统</title>
    <meta name="csrf-token" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="{{__ROOT__}}/node_modules/hdjs/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{__ROOT__}}/node_modules/hdjs/css/font-awesome.min.css" rel="stylesheet">
    <script>
        //HDJS组件需要的配置
        hdjs = {
            'base': '{{__ROOT__}}/node_modules/hdjs',
            'uploader': {{__ROOT__}}?s=component/upload/uploader&siteid=11',
            'filesLists': '{{__ROOT__}}?s=component/upload/filesLists&siteid=11',
            'removeImage': '{{__ROOT__}}?s=component/upload/removeImage&siteid=11',
            'ossSign': '{{__ROOT__}}?s=component/oss/sign&siteid=11',
        };
        window.system = {
            attachment: "{{__ROOT__}}/attachment",
            root: "{{__ROOT__}}",
            url: "{{__ROOT__}}/?s=site/entry/home&siteid=11",
            siteid: "11",
            module: "",
            //用于上传等组件使用标识当前是后台用户
            user_type: 'user'
        }
    </script>
    <script>
        if (navigator.appName == 'Microsoft Internet Explorer') {
            if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
            }
        }
    </script>
    <script src="{{__ROOT__}}/node_modules/hdjs/app/util.js"></script>
    <script src="{{__ROOT__}}/node_modules/hdjs/require.js"></script>
    <script src="{{__ROOT__}}/node_modules/hdjs/config.js"></script>
    <script src="{{__ROOT__}}/resource/js/hdcms.js"></script>
    <link href="{{__ROOT__}}/node_modules/hdjs/css/hdcms.css" rel="stylesheet">
    <script>
        require(['jquery'], function ($) {
            //为异步请求设置CSRF令牌
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
</head>
<body class="site">
<div class="container-fluid admin-top">
    <!--导航-->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <ul class="nav navbar-nav">

                    <li>
                        <a href="?s=system/site/lists">
                            <i class="fa fa-reply-all"></i> 返回系统
                        </a>
                    </li>


                    <li class="top_menu active">
                        <a href="?s=site/entry/home&siteid=11&mark=platform" class="quickMenuLink">
                            <i class="'fa-w fa fa-comments-o"></i> 微信功能                        </a>
                    </li>
                    <li class="top_menu">

                        <a href="?s=site/entry/home&siteid=11&mark=member" class="quickMenuLink">
                            <i class="'fa-w fa fa-cubes"></i> 会员粉丝                        </a>
                    </li>
                    <li class="top_menu">

                        <a href="?s=site/entry/home&siteid=11&mark=article" class="quickMenuLink">
                            <i class="'fa-w fa fa-cubes"></i> 文章系统                        </a>
                    </li>
                    <li class="top_menu">

                        <a href="?s=site/entry/home&siteid=11&mark=feature" class="quickMenuLink">
                            <i class="'fa-w fa fa-comments-o"></i> 系统设置                        </a>
                    </li>
                    <li class="top_menu">

                        <a href="?s=site/entry/home&siteid=11&mark=package" class="quickMenuLink">
                            <i class="'fa-w fa fa-arrows"></i> 扩展模块                        </a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                           style="display:block; max-width:150px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "
                           aria-expanded="false">
                            <i class="fa fa-group"></i> 后盾网 <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="?s=system/site/edit&siteid=11"><i class="fa fa-weixin fa-fw"></i>
                                    编辑当前账号资料
                                </a>
                            </li>
                            <li><a href="?s=system/site/lists"><i class="fa fa-cogs fa-fw"></i> 管理其它公众号</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="fa fa-w fa-user"></i>
                            liyalong                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="?s=system/user/myPassword">我的帐号</a></li>

                            <li><a href="?s=system/manage/menu">系统选项</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="?s=system/entry/quit">退出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--导航end-->
</div>
<!--主体-->
<div class="container-fluid admin_menu">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-lg-2 left-menu">
            <!--扩展模块动作 start-->
            <div class="panel panel-default">
                <!--系统菜单-->
                <div class="panel-heading">
                    <h4 class="panel-title">栏目管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus">
                    <li class="list-group-item" id="3">

                        <a class="pull-right append_url"
                           href="?s=site/rule/post&m=basic&siteid=11&mark=platform&mi=3">
                            <i class="fa fa-plus"></i>
                        </a>

                        <a href="?s=admin/category/lists"
                           class="quickMenuLink">
                            栏目列表                                            </a>
                    </li>
                    <li class="list-group-item" id="30">

                        <a class="pull-right append_url"
                           href="?s=site/rule/post&m=news&siteid=11&mark=platform&mi=30">
                            <i class="fa fa-plus"></i>
                        </a>

                        <a href="?s=admin/category/post"
                           class="quickMenuLink">
                            添加栏目                                            </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-lg-10">
            <!--有模块管理时显示的面包屑导航-->
            <blade name="content"/>


        </div>
    </div>
</div>
<div class="master-footer">
    <a href="http://www.houdunwang.com">猎人训练</a>
    <a href="http://www.hdphp.com">开源框架</a>
    <a href="http://bbs.houdunwang.com">后盾论坛</a>
    <br>
    Powered by hdcms v2.0 © 2014-2019 www.hdcms.com runtime: 0.09</div>

<script>
    require(['bootstrap']);
</script>
<!--右键菜单添加到快捷导航-->
<div id="context-menu">
    <ul class="dropdown-menu" role="menu">
        <li><a tabindex="-1" href="#">添加到快捷菜单</a></li>
    </ul>
</div>
<!--右键菜单删除快捷导航-->
<div id="context-menu-del">
    <ul class="dropdown-menu" role="menu">
        <li><a tabindex="-1" href="#">删除菜单</a></li>
    </ul>
</div>
<!--底部快捷菜单导航-->
<script src="http://www.houdunwang.com/resource/js/menu.js"></script>
<script src="http://www.houdunwang.com/resource/js/quick_navigate.js"></script>

</body>
</html>

<style>
    table {
        table-layout: fixed;
    }
</style>