<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use system\model\Config;



class Setting implements Middleware{
	//执行中间件  全局中间件会在应用启动时自动执行，不需要人为调用系统会自动执行全局中间件。
	public function run($next) {
//         echo "中间件执行了";

//获得数据库网站配置项的数据 使用全局中间件 可在全局使用网站配置项的数据
          $config=json_decode(Config::find(1)->pluck('content'),true)?:'';

//        v函数 全局变量管理
//v操作只对当前请求有效，请求结束后会释放数据。
           v('config',$config);

//dd( v('config',$config));

         $next();
	}
}