<?php namespace app\system\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Module as m;
class Module extends Controller{
    //构造函数 执行控制器中间件checksession 验证是否存在登录存入的session
    public function __construct()
    {
        //运行控制器中间件checksession
        Middleware::set('checksession');
    }

//分配已安装的模块的数据
    public function getModuleLists(){
        //从数据库中获得已安装的非系统模块的数据信息
        $installinfo = m::where('is_system','!=','是')->get();
//        p($installinfo->toArray());
         return View::with('installinfo',$installinfo);
    }

    //系统模块管理的控制器
    public function lists(){
//获得数据库的数据 分配到模板
//     $data = m::paginate(v('config')['article_row']);
        $this->getModuleLists();
//从数据库拿出来的数据 代表是已经安装的模块
//取得单一字段值的列表
//Db::table('user')->lists('username');
//满足条件记录的所有username字段
        $isInstall = m::where('is_system','!=','是')->lists('name');
//      p($isInstall);
//从目录里拿到的模块数据 不一定是安装过的
//        目录树Dir::tree('Home');
        $dirtree = Dir::tree('addons');
//p($dirtree);
       $data = [];
//循环判断拿到的目录树里所有的模块数据是否安装过
        foreach ($dirtree as $k=>$v){
//            p($v['filename']);
//定义路径
       $datafile ='addons/'.$v['filename'].'/config.php';
//p($datafile);
     if (is_file($datafile)){
          $configdata = include $datafile;//返回的是数组
//         p($configdata);
         $configdata['isinstall'] = in_array($v['filename'],$isInstall);
         $data[] = $configdata;

     }
        }
//        p($data);
     return view('',compact('data'));

    }


    //添加模块的方法 模块禁止修改
    public function post(m $module){
//作为用户角度 不能让用户创建系统拓展模块
        if (IS_POST){
            $post = Request::post();
           $is_system = $post['is_system']?$post['is_system']:'否';
//            dd($post);
            //判断数据库有没添加的信息 没有就添加 否禁止重复添加
            $check = m::where('name',$post['name'])->andwhere('is_system',$is_system)->first();
            if($check){
                return message('该模块已存在！请勿重复添加','back');
            }
//判断有没有创建的目录 没有就添加 否禁止重复添加
          $mpath = ($post['is_system']=='是')?'module':'addons';
//dd(is_dir($mpath.'/'.$post['name']));
           if (is_dir($mpath.'/'.$post['name'])){
               return message('该模块已设计！','back');
           }
            $this->makeModule($post);
            return message('添加成功','lists');

        }


//       //获得post表单提交的数据 存入数据库并且创建模块
//        if(IS_POST){
//            $post = Request::post();
////            p($post);
//           $this->makeModule($post);
//            $is_system = $post['is_system'] ?: '否';
//            $check = m::where('name',$post['name'])->andwhere('is_system',$is_system)->first();
//            if($check){
//                return message('该模块已存在！请勿重复添加','back');
//            }
//            $module->save($post);
//            return message('添加成功','lists');
//        }

        $this->getModuleLists();
        return  view();
    }

       //创建模块的方法
     public  function makeModule($post){
        //获得表单提交的创建的模块名称
        $name = $post['name'];
        //组合创建模块需要的目录结构
        $dirs = [

            'controller','model','system','template'
        ];
        //循环创建模块目录
        foreach ($dirs as $dir){
            //判断所要创建的模块是系统模块 还是非系统模块
   $dirPath = ($post['is_system'] == "是") ? 'module' : 'addons';
//创建模块目录  示例代码Dir::create('home/view');
            Dir::create($dirPath . '/' .$name . '/' . $dir);

        }
         $content = <<<str
<?php
namespace {$dirPath}\\{$name}\\system;

class Processor
{
    //动作
    public function index(){
        //代码在这里写
    }
}
str;
         //在system创建一个默认类
         file_put_contents($dirPath . '/' . $name . '/system/Processor.php',$content);
         //将post参数写入一个php文件保存到所创建的模块目录中 以待后面安装模块使用
         file_put_contents($dirPath . '/' .$name . '/config.php',"<?php return " . var_export($post,true) . ";?>");


   //在controller中创建一个user控制器 和一个index方法
         $content = <<<str
<?php
namespace addons\\{$name}\\controller;

class User{

     //动作
    public function index(){
        //代码写在这里
        }
}

str;

   file_put_contents($dirPath . '/' . $name . '/controller/User.php',$content);
     }


     //删除模块的方法 删除数据库数据 和模块目录
     public function delete(m $module){
         $name = Request::get('name');
//         p($name);
         //获得要删除的数据
         $data = m::where('name','=',$name)->first();
//p($module->toArray());
//           $data = $module->find($id);
//
//        // 删除目录Dir::del('Home');  删除文件 Dir::delFile($file);
////                dd($data['name']);
               if ($data['is_system']=='是'){
                   Dir::del("module/{$data['name']}");

               }else{

                   Dir::del("addons/{$data['name']}");
               }

//dd($data->toArray());
//删除数据库数据
         if ($data->destory()){
             return message('删除成功','lists');

         }else{//返回错误的方法
             return $this->error($module->getError());
         }

     }

     //安装有效模块的方法
        public function install(){

//         echo '我是安装模块的控制器';
//获得到要安装的模块的名称
           $name = Request::get('name');
//        p($name);
//获取到要安装的模块的信息文件config.php文件 作为数据存入数据库
            $post = include 'addons/'.$name.'/config.php';//返回的数组
//p($post);
            $module = new m();
            $module->save($post);
            return message('模块安装成功','lists');
        }

}
