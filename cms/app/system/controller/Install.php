<?php namespace app\system\controller;

use houdunwang\dir\Dir;
use houdunwang\request\Request;
use houdunwang\route\Controller;


class Install extends Controller{

public function __construct()
{
    $this->checkinstall();
}

    //判断用户是否已经安装 已安装的话跳走
    public function checkinstall(){

      if (is_file('lock.php')){
          return view('isInstalled');
      }
    }

    public function copyright(){
//        echo '我是安装cms系统的控制器';
//引入安装面板
           return view();
    }

//引入安装面板 下一步检查安装环境
//检测环境的控制器
              public  function check(){

                 //定义要检测的环境
                  $data = [
                      'server_software' => $_SERVER['SERVER_SOFTWARE'],
                      'php_version' => PHP_VERSION,
                      'curl' => extension_loaded('curl'),
                      'openssl' => extension_loaded('openssl'),
                      'gd' => extension_loaded('gd'),
                      'pdo' => extension_loaded('Pdo'),
                      'root_dir' => is_writable('.'),

                  ];

          return view('',compact('data'));

              }

//初始数据的控制器
     public function database(){
           //接收post提交的表单 获得用户初始数据库的信息
         if (IS_POST){
             $post = Request::post();
//             dd($post);
//使用post提交的用户数据库连接信息 尝试连数据库
             $this->connection($post);
//连接成功的话 创建cms项目所需要的表
//      函数式执行命令除了可以在命令行工作外，也可以使用php函数方式调用 cli处理。
             cli('hd migrate:make');
             cli('hd seed:make');
//生成上传文件的表attachment
             $sql = <<<str
DROP TABLE IF EXISTS `attachment`;
CREATE TABLE `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员编号',
  `name` varchar(80) NOT NULL,
  `filename` varchar(300) NOT NULL COMMENT '文件名',
  `path` varchar(300) NOT NULL COMMENT '文件路径',
  `extension` varchar(10) NOT NULL DEFAULT '' COMMENT '文件类型',
  `createtime` int(10) NOT NULL COMMENT '上传时间',
  `size` mediumint(9) NOT NULL COMMENT '文件大小',
  `data` varchar(100) NOT NULL DEFAULT '' COMMENT '辅助信息',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `content` text NOT NULL COMMENT '扩展数据内容',
  PRIMARY KEY (`id`),
  KEY `data` (`data`),
  KEY `extension` (`extension`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='附件';
str;
//             执行多条SQL语句Schema::sql($sql);
             Schema::sql($sql);
          return $this->setRedirect('finish')->success('数据库初始化成功');

         }
           return view();
     }

//连接数据库的控制器
     public function connection($data){
         //PDO连接数据库
         $dsn="mysql:host={$data['host']};dbname={$data['database']}";
           try{
               new \PDO($dsn,$data['user'],$data['password']);
//如果连接成功 将接收到post的参数写入php文件
//               创建目录Dir::create('home/view');
                  Dir::create('data');
             file_put_contents('data/database.php',"<?php return " . var_export($data,true) . ";?>");
           } catch (\Exception $e){
//抛出错误信息
            $this->error($e->getMessage());

           }
     }

//cms项目安装完毕执行生成lock.php文件
        public function finish(){
//touch新建一个不存在的文件
             touch('lock.php');
             return  view();
        }


}
