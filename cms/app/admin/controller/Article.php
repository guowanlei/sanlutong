<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use houdunwang\view\View;
use module\wx\model\Keyword;
use system\model\Article as Articlemodel;
use system\model\Category;
class Article extends Controller{


    //构造函数 执行控制器中间件checksession 验证是否存在登录存入的session
    public function __construct()
    {
        //运行控制器中间件checksession
        Middleware::set('checksession');

    }


    //文章列表的方法
    public function lists(){

//        echo '我是文章列表的方法';

        //拿到文章数据库所有数据
        $data   = Articlemodel::getArticle();
//        p($data->toArray());
//引入文章列表模板  同时分配数据
        return  View::make()->with(compact('data'));

    }


    //修改文章 或是 添加文章的方法
    public function post(Articlemodel $Articlemodel){
//        echo '我是添加或是删除的方法';
//如果没有IS_POST 有cid参数过来说明是修改栏目数据
        $aid =Request::get('aid');//获得aid 数值从数据库找到具体的数据
//        $model  = $Articlemodel->find($aid);
        $model = $aid ? $Articlemodel->find($aid) : $Articlemodel;

        //IS_POST=1 判断是否有post参数 等于1为真 代表是添加栏目数据
        if (IS_POST){
//获得post表单提交的内容
            $post = Request::post();
            //存入数据库  获得返回的自增id
            $lastid=$model->save($post);
            $content_id = $aid ? $aid : $lastid;

//将微信自动回复文章的关键字重组数组 存入关键字表中
            $keywordarray=[
                'keyword'=>$post['keywords'],
                'module'=>'article',
                 'content_id'=>$content_id,
            ];


            $keyword = $aid ? Keyword::where('content_id','=',$aid)->first() : new Keyword();
            $keyword ->save($keywordarray);

            //message方法 返回保存结果 调回列表页面
            return message('保存成功','lists');
        }

        //获得数据库所有栏目的数据 用于文章添加或是修改来选择
        $data = Category::getCategory();

        return view('',compact('data','model'));
//        return View::make();

    }

//删除文章的方法
     public function delete(Articlemodel $Articlemodel){

         $aid = Request::get('aid');
    //删除文章的时候  关键字也要删除
            $keyword = Keyword::where('content_id','=',$aid)->first();
             $keyword->destory();

         //先获取到需要删除的数据
         if($Articlemodel->deleteArticle($aid)){
//            return $this->setRedirect('lists')->success('删除成功');
             return message('删除成功','lists');
         }else{
             return $this->error($Articlemodel->getError());
         }
//        return message('保存成功','lists');
         //返回成功或者失败信息的方法二


     }


}
