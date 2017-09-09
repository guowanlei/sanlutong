<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use houdunwang\session\Session;
use system\model\User;

class Checksession implements Middleware{
	//执行中间件  获得session
	public function run($next) {
//获得登录成功是存入的session 用户的uid和username
       $uid = Session::get('uid');
//p($uid);
       if ($uid){
//如果存在session 通过session里存入的uid 拿到这一条用户的数据信息
       //通过v函数转成全局变量使用
           v('userinfo',User::find($uid)->toArray());
//           p(User::find($uid)->toArray());
        }else{
//如果不存在session 没有用户登录 禁止进入后台管理 跳转到登录页面
       return message('请先登录','admin/login/login');
       }


         $next();
	}



}