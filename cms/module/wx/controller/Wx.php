<?php
namespace module\wx\controller;

use houdunwang\request\Request;
use houdunwang\view\View;
use module\Hdcontroller;
use module\wx\model\Keyword;
use module\wx\model\Wxcontent;

class Wx extends Hdcontroller {


//展示关键字和关键字回复的方法
    public function index(){
//需要获得关键字表和关键字回复内容表
        $data = Keyword::field('keyword.keyword,wxcontent.*')->

        join('wxcontent','keyword.content_id','=','wxcontent.id')->paginate(3);

//dd($data);
        return view($this->template.'wx/index',compact('data'));
//          return View::make($this->template.'wx/index')->with(compact('data'));
    }

//添加和修改关键字和关键字自动回复的方法
   public function post(){
//获得要修改的数据的id 从index列表方法可知这里用的id是回复内容表里wxcontent的id 不是关键字keyword的id
           $id =  Request::get('id');
//dd($id);
            $wxcontent  = $id?   Wxcontent::find($id):new Wxcontent();

//dd($wxcontent->toArray());

     if (IS_POST){

         //接收post表单提交的数据
         $post = Request::post();
         //先存关键字回复内容的表 获得自增id
         $lastid  = $wxcontent ->save($post);
         $content_id = $id?$id:$lastid;

//         dd($lastid);
         //再将关键字存入数据库
//存入回复内容的自增id($lastid) 就是关键字存入的时候对应的content_id
//获得要存入的关键字属于哪个模块
       $module = Request::get('m');
//要存入的关键字表的字段需要重组数组
     $data = [
           'module'=>$module,
          'keyword'=>$post['keyword'],
           'content_id'=>$content_id,
         ];
             $this->saveKeyword($data);

         return message('保存成功',url('wx.index'));

     }
              //获得要修改的关键字的方法
              $this->getKeyword($id);

        return view($this->template.'wx/post',compact('wxcontent'));
   }

//删除关键字和关键字回复的方法
       public function delete(){
           //获得要删除的数据  删除回复内容表的数据
           $id = Request::get('id');
            $data = Wxcontent::find($id);
//p($data->toArray());
           $data->destory();
//删除关键字表中的数据
       $this->removeKeyword($id);

//返回删除成功的方法
            return message('删除成功',url('wx.index'));

       }


}








