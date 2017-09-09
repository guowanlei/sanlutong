<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use houdunwang\request\Request;
use system\model\Config;
use system\model\Weixinconfig as weixinconfigmodel;


class Boot implements Middleware{
	//执行中间件
//全局中间件会在应用启动时自动执行，不需要人为调用系统会自动执行全局中间件。
//修改配置文件 system/config/middleware.php 中的global配置段来设置中间件处理类。
	public function run($next) {

//    全局中间件系统会自动执行不需要人为调用 会在路由解析前执行
//        所以在这里判断用户有没有安装cms系统
           $this->isInstall();

//如果用户安装了cms系统  执行其他的中间件

        if(is_file('lock.php')){

            $this->setting();
            $this->weixinconfig();
        }
         $next();
	}


//判断用户是否安装cms系统的方法
// 如果存在lock.php 说明以安装 不存在代表没有安装 需要跳转到安装cms的控制器
    public function isInstall(){
	    if (!is_file('lock.php') && !preg_match('@system/install@i',Request::get('s'))){
	        go(u('system.install.copyright'));
        }
    }

public function setting(){
//获得数据库网站配置项的数据 使用全局中间件 可在全局使用网站配置项的数据
    $config=json_decode(Config::find(1)->pluck('content'),true)?:'';

//        v函数 全局变量管理
//v操作只对当前请求有效，请求结束后会释放数据。
    v('config',$config);
}


public function weixinconfig(){

    //c函数是用来快速获取/设置配置项而产生，设置并不会更改配置文件，只是影响当前请求的内存中的配置项。

//获得与微信连接配置有关的配置项数据wechat
    $wechatconfig = c('wechat');
//获得微信在数据库中配置项的数据
    $data = weixinconfigmodel::find(1);

    if ($data){

        $data = $data->toArray();
    }else{

        $data = [];
    }
//p($data);
//将数据库微信配置项与框架微信配置项合并
    $result = array_merge($wechatconfig,$data);
//在使用c函数调用配置
    c('wechat',$result);

}



}