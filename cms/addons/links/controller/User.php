<?php
namespace addons\links\controller;

use addons\links\model\Yqlinks;
use houdunwang\request\Request;
use module\Hdcontroller;
use app\system\controller\Module;



class User extends Hdcontroller {

     //展示友情链接的控制器和方法
    public function index(){
        //获得已安装的模块分配到父级模板中 在左侧边栏中展示
         $module = new Module();
        $module->getModuleLists();

//拿到数据库友情链接的数据分配到展示模板中
        $data = Yqlinks::paginate(4);
//        p($data);

//引入友情链接的模板
      return view($this->template.'user/index.php',compact('data'));

        }


     //添加友情链接的方法
    public function post(){

       $data = Request::get('id')?Yqlinks::find(Request::get('id')):new Yqlinks();

            if (IS_POST){
                $post = Request::post();
                //        p($post);
//                $yqlinks = new Yqlinks();
                $data->save($post);
                //返回保存成功的信息 跳转到展示的列表也
                return message('保存成功',url('user.index.php'));
            }
        //获得已安装的模块分配到父级模板中 在左侧边栏中展示
        $module = new Module();
        $module->getModuleLists();
//引入添加友情链接的模板
        return view($this->template.'user/post.php',compact('data'));

    }

//删除友情链接的方法
      public function delete(){
//获得要删除的数据的id
     $id = Request::get('id');

   //找到数据库中这条数据
        $data = Yqlinks::find($id);
//          dd($data->toArray());
//执行删除
          if ($data){
              $data->destory();

             return message('删除成功',url('user.index.php')) ;
          }

          return $this->success('删除失败');

      }

}
