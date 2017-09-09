<?php namespace app\system\controller;

use houdunwang\route\Controller;
use houdunwang\backup\Backup as back;
use houdunwang\request\Request;
class Backup extends Controller{


    //构造函数 执行控制器中间件checksession 验证是否存在登录存入的session
    public function __construct()
    {
        //运行控制器中间件checksession
        Middleware::set('checksession');
    }

//获取备份数据的列表
    public function lists(){
//        备份成功的目录会创建lock.php文件，使用以下方法可以获取正确的备份目录。

$dirs = back::getBackupDir('backup');
//p($dirs);

        return view('',compact('dirs'));

    }

    //执行备份数据的方法
       public function backup(){
           $config = [
               'size' => 200,//分卷大小单位KB
               'dir'  => 'backup/' . date( "Ymdhis" ),//备份目录
           ];
           $status = back::backup( $config, function ( $result ) {
               if ( $result['status'] == 'run' ) {
                   //备份进行中
                   echo $result['message'];
                   //刷新当前页面继续下次
                   echo "<script>setTimeout(function()		{location.href='{$_SERVER['REQUEST_URI']}'},500);</script>";
               } else {
                   //备份执行完毕
                   die(message($result['message'],'system.setting.lists'));

               }
           } );
           if($status===false){
               //备份过程出现错误
               echo  back::getError();
           }

       }

//还原备份的方法
     public function recovery(){
         $name = Request::get('name');
         //要还原的备份目录
         $config=['dir'=>'backup/' . $name];
         $status = back::recovery( $config, function ( $result ) {
             if ( $result['status'] == 'run' ) {
                 //还原进行中
                 echo $result['message'];
                 //刷新当前页面继续执行
                 echo "<script>setTimeout(function(){location.href='{$_SERVER['REQUEST_URI']}'},1000);</script>";
             } else {
                 //还原执行完毕
                 die(message($result['message'],'system.setting.lists'));
             }
         } );
         if($status===false){
             //还原过程出现错误
             echo  back::getError();
         }

     }

//删除备份的方法
      public function delete(){
//获得要删除的备份目录
          $name = Request::get('name');
          Dir::del('backup/' . $name);
          return message('删除成功','system.setting.lists');

      }

}
