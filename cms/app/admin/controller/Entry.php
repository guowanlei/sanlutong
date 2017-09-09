<?php
//header('content-type:text/html;charset=utf-8');

//命名空间
namespace app\admin\controller;

use houdunwang\view\View;

//进入后台的类 Entry控制器
class Entry {

    //构造函数 执行控制器中间件checksession 验证是否存在登录存入的session
    public function __construct()
    {
        //运行控制器中间件checksession
        Middleware::set('checksession');

    }


    //引入后台首页的方法
    public function index(){

//        echo '我是后台首页';
     return View::make();
    }

}








