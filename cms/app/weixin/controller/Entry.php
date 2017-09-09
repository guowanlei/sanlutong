<?php namespace app\weixin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use houdunwang\wechat\WeChat;
use system\model\Weixinconfig;

class Entry extends Controller{


    //构造函数 执行控制器中间件checksession 验证是否存在登录存入的session
    public function __construct()
    {
        WeChat::valid();
        //运行控制器中间件checksession
        Middleware::set('checksession');

    }

    //微信管理的控制器
    public function index(Weixinconfig $weixinconfig){

         $model = $weixinconfig->find(1)?:$weixinconfig;

            if (IS_POST){
                $post = Request::post();
                $model->save($post);

                return message('保存成功','refresh');
            }

              if (empty(c('wechat.token'))){
                $token = md5(time());
                c('wechat.token',$token);

              }
        if(empty(c('wechat.encodingaeskey'))){
            $encodingaeskey = md5(microtime()) . substr(md5(time()),0,11);
            c('wechat.encodingaeskey',$encodingaeskey);
        }

      return view();

    }


    // 系统回复( 匹配不到关键字的默认回复 和 关注公众号的默认回复)

    public function reply(){

        $model = Weixinconfig::find(1) ?: new Weixinconfig();

          if (IS_POST){
              $post = Request::post();
//              dd($post);
              $model->save($post);
              return message('保存成功','refresh');
          }

         return  view('',compact('model'));

    }

}
