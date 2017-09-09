<?php
//header('content-type:text/html;charset=utf-8');


namespace app\admin\controller;

use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Category as CategoryModel;
use system\model\Module;
use Request ;
class Category extends Controller{

    //构造函数 执行控制器中间件checksession 验证是否存在登录存入的session
    public function __construct()
    {
        //运行控制器中间件checksession
        Middleware::set('checksession');

    }


    //获得栏目列表的方法
    public function lists(){

           //连接数据库 拿到数据的方法
             $data= CategoryModel::getCategory();

//             p($data);die;


        //引入模板 同时分配数据
        return View::make()->with(compact('data'));

    }

    //添加栏目或是修改栏目的方法
     //第一个参数传入模型类   第二个参数是模型类实例化的对象 调用将数据存入数据库的方法
     public function post(CategoryModel $CategoryModel){
//如果没有IS_POST 有cid参数过来说明是修改栏目数据
            $cid =Request::get('cid');//获得cid 数值从数据库找到具体的数据
             $model = $cid ? $CategoryModel->find($cid) : $CategoryModel;
//            $data  = $CategoryModle->find($cid);
////             p($data);die;
//            $data->getCategoryByCid($cid);
//
//        //IS_POST=1 判断是否有post参数 等于1为真 代表是添加栏目数据
            if (IS_POST){
//           p(IS_POST);die;
           //存入数据库
                $model->save(Request::post());
           //message方法 返回保存结果 调回列表页面
           return message('保存成功','lists');
         }

//引入修改或是添加的模板 同时分配数据
//           return View::make();
         $data = $model->getCategoryByCid($cid);
         return view('',compact('data','model'));
}

//删除数据的方法
    public function delete(CategoryModel $category){
        $cid = Request::get('cid');
        //先获取到需要删除的数据
        if($category->deleteCategory($cid)){
//            return $this->setRedirect('lists')->success('删除成功');
            return message('删除成功','lists');
        }else{
            return $this->error($category->getError());
        }
//        return message('保存成功','lists');
        //返回成功或者失败信息的方法二

    }





}
















