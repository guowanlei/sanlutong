<?php namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use system\model\Article;
USE system\model\Flash as Flashmodel;
class Flash extends Controller{

    //构造函数 执行控制器中间件checksession 验证是否存在登录存入的session
    public function __construct()
    {
        //运行控制器中间件checksession
        Middleware::set('checksession');

    }

    //轮播图列表的方法
    public function lists(){
      $data = Flashmodel::field('flash.*,article.title,category.catname')->
      join('article','flash.article_aid','=','article.aid')->
      join('category','article.categorycid','=','category.cid')->paginate(v('config')['article_row']);

//dd($data->toArray());
      return view('',compact('data'));

    }


   //轮播图添加的方法
    public function post(Flashmodel $Flashmodel ){
//获得要修改的数据的fid
         $fid = Request::get(fid);
//p($fid);
$model =$fid ? $Flashmodel->find($fid):$Flashmodel;

      if (IS_POST){
        $post = Request::post();
          $model ->save($post);
        return message('保存成功','lists');
       }

    //从数据库获得被选择的推荐的文章
        $article = Article::where('iscommend','=','是')->get();
//        dd($article->toArray());
        return view('',compact('article','model'));

    }


    //删除一条轮播图的方法
    public function delete(Flashmodel $Flashmodel){
         //获得要删除的数据的fid
        $fid = Request::get(fid);
//        p($fid);
        //获得要删除的数据
            $data=$Flashmodel->find($fid);
//p($data);
           if ($data->destory()){
    return message('删除成功','lists');

       }else{//返回错误的方法
               return $this->error($Flashmodel->getError());
           }



    }


}
