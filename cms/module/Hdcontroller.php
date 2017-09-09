<?php

namespace module;



use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use module\wx\model\Keyword;
use system\model\Module;
class Hdcontroller extends Controller {
    protected  $template;//存入要引入的模板的属性
    //示例代码 最终要引入的模板的地址最终访问地址 'module/wx/template/wx/index.php'
    //    构造函数 执行控制器中间件checksession 验证是否存在登录存入的session
    public function __construct()
    {
//运行控制器中间件checksession
        Middleware::set('checksession');


//        dd(Request::get('m'));

        $model = Module::where('name',Request::get('m'))->first();
        $path = ($model['is_system'] == '是') ?'module' : 'addons';
        $this->template = $path . '/'. Request::get('m') . '/template/';
//dd(  $this->template );
    }



//存入关键字的方法
    public function saveKeyword(array $data){

        $keyword = Keyword::where('content_id','=',$data['content_id'])->first();
//        dd($keyword);
        if ($keyword){
// 要更新模型前必须先取出它，然后使用 save 方法完成更新操作。
//$model ＝ News::find(1); // 查找主键为1的数据
//$model->title = 'hdphp'; // 修改数据对象
//$model->save(); // 保存当前数据对象
              $keyword->keyword = $data['keyword'];
                $keyword->save;
          }else{

           $keyword = new Keyword();
           $keyword->save($data);

        }

    }
//获得要修改的关键字的方法
    public function getKeyword($id){
       $data = Keyword::where('content_id','=',$id)->pluck('keyword');
//dd($data);
//将获得的关键字分配到模板
              View::with('keyword',$data);
    }


//删除关键字的方法
      public function removeKeyword($content_id){
        $data = Keyword::where('content_id','=',$content_id)->first();
//dd($data);
           $data->destory();

      }

}












