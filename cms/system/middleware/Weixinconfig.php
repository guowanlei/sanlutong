<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use system\model\Weixinconfig as weixinconfigmodel;
class Weixinconfig implements Middleware{
	//执行中间件 微信配置连接的全局变量
	public function run($next) {
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

         $next();
	}
}