<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{v('config.webname')}}</title>
    <meta name="csrf-token" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name=”keywords” content=”{{v('config.description')}}” />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="{{__ROOT__}}/node_modules/hdjs/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{__ROOT__}}/node_modules/hdjs/css/font-awesome.min.css" rel="stylesheet">

    <script>
        if (navigator.appName == 'Microsoft Internet Explorer') {
            if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
            }
        }
    </script>

    <meta name="csrf-token" content="{{csrf_token()}}">
    <script>
        //模块配置项
        var hdjs = {
            //框架目录
            'base': 'node_modules/hdjs',
            //上传文件后台地址
            'uploader': '?s=component/upload/uploader',
            //获取文件列表的后台地址
            'filesLists': '?s=component/upload/filesLists',
        };
    </script>
    <script src="{{__ROOT__}}/node_modules/hdjs/app/util.js"></script>
    <script src="{{__ROOT__}}/node_modules/hdjs/require.js"></script>
    <script src="{{__ROOT__}}/node_modules/hdjs/config.js"></script>
    <link href="{{__ROOT__}}/resource/css/hdcms.css" rel="stylesheet">
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
                    <li class="top_menu">
                        <a href="{{u('home.entry.index')}}">
                            <i class="fa fa-reply-all"></i> 返回首页 </a>
                    </li>
                    <li class="top_menu">
                        <a href="{{u('admin.entry.index')}}">
                            <i class="'fa-w fa fa-cubes"></i> 网站管理                        </a>
                    </li>
                    <li class="top_menu active">

                        <a href="{{u('weixin.entry.index')}}">
                            <i class="'fa-w fa fa-cubes"></i> 微信管理                        </a>
                    </li>
<!--                    <li class="top_menu">-->
<!--                        <a href="{{u('system.module.lists')}}">-->
<!--                            <i class="fa-w fa fa-cubes"></i> 系统管理</a>-->
<!--                    </li>-->

                    <li class="top_menu">
                        <a href="{{u('system.module.lists')}}">
                            <i class="fa-w fa fa-cubes"></i> 模块管理</a>
                    </li>
                    <li class="top_menu ">

                        <a href="{{u('system.setting.lists')}}" class="quickMenuLink ">
                            <i class="'fa-w fa fa-cubes"></i> 系统管理   </a>
                    </li>







<!--                    <li class="top_menu">-->
<!---->
<!--                        <a href="?s=site/entry/home&siteid=11&mark=article" class="quickMenuLink">-->
<!--                            <i class="'fa-w fa fa-cubes"></i> 文章系统                        </a>-->
<!--                    </li>-->
<!--                    <li class="top_menu">-->
<!---->
<!--                        <a href="?s=site/entry/home&siteid=11&mark=feature" class="quickMenuLink">-->
<!--                            <i class="'fa-w fa fa-comments-o"></i> 系统设置                        </a>-->
<!--                    </li>-->
<!--                    <li class="top_menu">-->
<!---->
<!--                        <a href="?s=site/entry/home&siteid=11&mark=package" class="quickMenuLink">-->
<!--                            <i class="'fa-w fa fa-arrows"></i> 扩展模块                        </a>-->
<!--                    </li>-->
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="fa fa-w fa-user"></i>    {{v('userinfo.username')}}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="?s=system/user/myPassword">我的帐号</a></li>

                            <li><a href="?s=system/manage/menu">系统选项</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="?s=admin/login/changepassword">修改密码</a></li>
                            <li><a href="?s=admin/login/loginout">退出</a></li>


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
            <div class="search-menu">
                <input class="form-control input-lg" type="text" placeholder="输入菜单名称可快速查找"
                       onkeyup="search(this)">
            </div>
            <!--扩展模块动作 start-->
            <div class="panel panel-default">
                <!--系统菜单-->
                <div class="panel-heading">
                    <h4 class="panel-title">微信连接</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus">
                    <li class="list-group-item">
                        <a href="{{u('weixin.entry.index')}}">连接设置</a>
                    </li>
                </ul>
                <div class="panel-heading">
                    <h4 class="panel-title">微信功能</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus">
                    <li class="list-group-item">
                        <a href="?m=wx&action=controller/wx/index">文本回复设置</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{u('weixin.entry.reply')}}">系统回复</a>
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
    联系电话：{{v('config')['tell']}}
</div>

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