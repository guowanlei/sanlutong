<?php namespace app\system\controller;

use houdunwang\route\Controller;
use houdunwang\backup\Backup as back;
class Setting extends Controller{

    //构造函数 执行控制器中间件checksession 验证是否存在登录存入的session
    public function __construct()
    {
        //运行控制器中间件checksession
        Middleware::set('checksession');
    }

    //动作
    public function lists(){



        $dirs = back::getBackupDir('backup');
//p($dirs);

        return view('',compact('dirs'));
    }





}
