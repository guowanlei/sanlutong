<?php namespace app\weixin\controller;

use houdunwang\route\Controller;
use module\wx\model\Keyword;
use system\model\Module;
use system\model\Weixinconfig;

class Api extends Controller
{
    public function __construct()
    {
        WeChat::valid();
        //运行控制器中间件checksession
        Middleware::set('checksession');
    }

    //动作
    public function index() {
   //获得数据库微信配置表中系统回复(找不到关键字的回复 用户关注的回复)
        $systemmessage = Weixinconfig::find(1);

//        dd($systemmessage);
//实例化消息模块
        $instance = WeChat::instance('message');
        //获得用户发过来的消息
        $content = $instance->Content;
//判断是否是关注事件
            if ($instance->isSubscribeEvent()){
                //向用户回复默认的系统关注回复信息
                $instance->text($systemmessage['welcome']);
            }

//先获得用户发过来的消息 与数据库的关键字表匹配 查询是否有关键字
           $keyword = Keyword::where('keyword','=',$content)->first();
        if ($keyword){

            //如果匹配到关键字 要获得关键字所属模块我属于wx回复 还是article回复
            $module = Module::where('name','=',$keyword['module'])->first();
//判断是否是系统模块module还是非系统模块addons

            $path = ($module['is_system']=='是')?'module':'addons';
//组合一个带命名空间的类 实例化具体的模块对象 回复用户具体的内容
        $class = $path.'\\'.$keyword['module'].'\\'. 'system\\Processor';
            $a = 'index';//方法名
//            $instance->text($class);

//实例化
            return call_user_func_array([new $class,$a],[$keyword['id']]);

        }

        //如果匹配不到关键字 回复默认回复
        $instance->text($systemmessage['default_message']);

    }




}