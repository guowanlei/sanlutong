<?php namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use system\model\Config as ConfigModel;
class Config extends Controller{


    //构造函数 执行控制器中间件checksession 验证是否存在登录存入的session
    public function __construct()
    {
        //运行控制器中间件checksession
        Middleware::set('checksession');

    }

    //操作网站配置项的控制器 和方法
    public function setting(ConfigModel $config){
//如果数据库有数据 获得数据库数据
          $model = $config->find(1)?:$config;
        if ($model->toArray()){

          $dataconfig =json_decode($model->pluck('content'),true) ;

//          p($dataconfig);
        }else{

            $dataconfig=[];
        }



if (IS_POST){
    //获得post提交的配置项数据
    $post = Request::post();
//    p($post);

    if ( $model->SaveConfig($post)){

        return message('保存成功','refresh');
    }
    return message('保存失败');

}

        //引入网站配置项的模板
        return view('', compact('dataconfig'));

    }





}
