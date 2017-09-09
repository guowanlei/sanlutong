<?php
namespace addons\sousuo\controller;

use addons\sousuo\model\Sousuo;
use houdunwang\request\Request;
use module\Hdcontroller;
use system\model\Article;
use app\system\controller\Module;

class User  extends  Hdcontroller {

    //搜索文章的方法
    //思路是：先通过输入的关键词，来匹配是否有相应的文章能被搜索出来
    //如果有文章被匹配到，将文章数据拿出来，分配到搜索结果的模板，
    //将搜索的关键词存入搜索关键词的表中，并且判断表中是否有该数据
    //有的话，搜索次数+1，没有的话，添加一条新数据
    public function sousuo(){
        //获得用户搜索的关键字
          $keyword = Request::get('keyword');
//        p($keyword);
//与 数据库里文章表来匹配 可能有数据匹配 也可能为空 匹配规则（标题 介绍 作者 关键字 内容 ）
           $articleData = Article::where('title','like',"%{$keyword}%")->
           orwhere('description','like',"%{$keyword}%")->
           orwhere('author','like',"%{$keyword}%")->
           orwhere('keywords','like',"%{$keyword}%")->
           orwhere('content','like',"%{$keyword}%")->get();
//p($articleData->toArray());如果能匹配到关键字文章 存储热门搜索关键字
             if ($articleData){
//存储热门搜索关键字 存在两种可能
//第一在热门搜索关键字表中有该条数据 只让此条数据搜索量sousuo_num加1
             //获得热门搜索关键字表所有的数据
                 $iskeyword = Sousuo::where('keyword','=',$keyword)->first();
//                 p($iskeyword->toArray());
                 if ($iskeyword){
//                     将total字段值加2Db::table("user")->where('id',1)->increment('total',2);
              Db::table('sousuo')->where('keyword','=',$keyword)->increment('sousuo_num',1);
                 }else{
                    //第二  热门搜索关键字表中没有该条数据 向数据库中添加此数据
               $sousuo = new Sousuo();
                $data = ['keyword'=>$keyword,
                          'sousuo_num'=>1
                    ];
                     $sousuo->save($data);
                 }

             }
        $hotkeyword = Db::table('Sousuo')->orderBy('sousuo_num','DESC')->get();
      return  view('tpl/web/sousuo.html',compact('articleData','hotkeyword'));
        }




        //展示热门搜索关键字的方法
        public function index(){
//获得数据库所有热门搜索关键字
           $data = Sousuo::get();
//           dd($data->toArray());
//            dd($this->template.'user/index');

            //获得已安装的模块分配到父级模板中 在左侧边栏中展示
            $module = new Module();
            $module->getModuleLists();

            return view($this->template.'user/index',compact('data'));
        }

}
