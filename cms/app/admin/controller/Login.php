<?php namespace app\admin\controller;

use houdunwang\code\Code;
use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\session\Session;
use houdunwang\view\View;
use system\model\User;
class Login extends Controller{

    public function __construct()
    {
        //登录方法不需要验证session  除了login方法外 其他方法都可以调用
        Middleware::set('checksession', ['except' => ['login']]);
    }


    //引入登录模板的方法
    public function login(){
//引入登录模板
return View::make();

    }


    //验证登录用户和密码的方法
public function post(){

        //第一种登录的验证方法
//     $username=$_POST['username'];
//     $password=$_POST['password'];
//     p($password);die;
//1判断数据库user表中是否有当前用户
//    $data = User::where("username = '{$username}'")->get();//->toArray();
//    dd($data);
//如果用户名不存在 返回用户名不存在 跳转回登录页面 存在走下步 验证密码
//    if(!isset($data[0]['username'])){
//    if(empty($data)){
//        return message('用户名不存在','login');
//    }
    //2判断密码   如果用户名通过验证 判断如果用户输入飞密码与数据库的密码是否相同
    // 相同进入后台管理 否则返回密码错误跳回登录页面
//       if(md5($password.'houdunwang')!=$data[0]['password']){
//           return message('密码错误','login');
//       }

//echo '你好 欢迎登录后台管理';
//     return message('欢迎登陆成功','admin/entry/index');

//第二种 新的方法验证登录用户名和密码

    if (IS_POST){
        //获得用户输入的姓名和密码的post提交的数据
        $post = Request::post();//和$POST获得的表单提交数据是一样的

//        dd($post);


       //调用模型层的login方法进行验证
        return User::login($post);
    }

}

//显示验证码的方法
      public function code(){

//          Code::num(6)->make();
          Code::width(200)->height(50)->make();
          Code::fontSize(60)->fontColor('#f00f00')->make();
          Code::make();

      }


      //退出登录的方法 同时清除session
      public function loginout(){
        //删除session
          Session::del('uid');
          Session::del('username');
          Session::flush();
          return message('退出成功','login');
      }


        //修改密码的方法
        public function changepassword(User $user){

          if (IS_POST){
//p(Request::post());
               return  $user->changePassword(Request::post());
                }

          return view();
     }

}
