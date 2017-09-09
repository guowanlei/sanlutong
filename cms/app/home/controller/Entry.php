<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace app\home\controller;

use addons\links\model\Yqlinks;
use addons\sousuo\model\Sousuo;
use houdunwang\request\Request;
use houdunwang\route\Controller;
use system\model\Module;

class Entry extends Controller
{
    protected $template;//用来存储判断是pc端访问还是移动端访问的方法
    public function __construct()
    {
        //判断是pc端访问还是mobile端访问
        $this->template = 'tpl/' . (IS_MOBILE ? 'mobile' : 'web') ;
        define('__TEMPLATE__',__ROOT__ . '/' . $this->template);
        $this->makeurl();

    }


    public function index()
    {
        //获得友情链接的数据 展示在主页面
        $data = Yqlinks::get();
//        p($data);
//        Db::table('user')->orderBy('id','DESC')->get();排序
        $hotkeyword = Db::table('Sousuo')->orderBy('sousuo_num','DESC')->get();
//        dd($hotkeyword);
        return view($this->template . '/index.html',compact('data','hotkeyword'));

    }


//框架默认的是?s参数在应用目录APP找控制器和方法
//这里拓展模块用其他参数绕过
    //拓展模块跳转的方法
    public function makeurl(){
//        http://localhost/cms/index.php?m=module/wx&action=controller/wx/index
       //获得m参数 转化为命名空间 '/'转成命名空间的'\';
//        $module= str_replace('/','\\', Request::get('m'));
//        dd($module);
        $module = Module::where('name',Request::get('m'))->first();
        $path = ($module['is_system'] == '是') ? 'module' : 'addons';

//dd( $path);
        //获得action参数 转成要实例化的对象
        $action = Request::get('action');
//        dd($action);

        //判断 $module $action参数都存在时 进行实例化 跳转
     if ($module && $action){
         //转成数组 获得要实例化的类
         $info = explode('/',$action);
             //类名要大写
           $info[1] = ucfirst($info[1]);
//         dd($info);
//组合要实例化的类
         $class = $path . '\\'. Request::get('m') . '\\' . $info[0] . '\\' . $info[1];
//dd($class);
              //获得实例化对象调用的方法
         $a =   $info[2];
//         dd($class);
         die(call_user_func_array([new $class, $a], []));
     }
        return false;
    }

//前台栏目列表的方法
     public function lists(){

         $hotkeyword = Db::table('Sousuo')->orderBy('sousuo_num','DESC')->get();
        return view($this->template.'/list.html',compact('hotkeyword'));
     }

//前台文章详情控制器
       public function content(){
           $hotkeyword = Db::table('Sousuo')->orderBy('sousuo_num','DESC')->get();
         return view($this->template.'/content.html',compact('hotkeyword'));

       }








}