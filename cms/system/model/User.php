<?php namespace system\model;
use houdunwang\model\Model;
use houdunwang\session\Session;

class User extends Model{
	//数据表
	protected $table = "user";

	//允许填充字段
	protected $allowFill = ['*' ];

	//禁止填充字段
	protected $denyFill = [ ];

	//自动验证
	protected $validate=[
		//['字段名','验证方法','提示信息',验证条件,验证时间]

//        ['username','required ','请输入用户名',4],


	];

	//自动完成
	protected $auto=[
		//['字段名','处理方法','方法类型',验证条件,验证时机]
	];

	//自动过滤
    protected $filter=[
        //[表单字段名,过滤条件,处理时间]
    ];

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps=false;

static public function login($data){
//    dd($data);
//首先判断用户名和密码是否为空
    $username=$data['username'];
    $password=$data['password'];
      $code  =$data['code'];

    //用户名为空时
if (empty($username) ){
//return ['valid'=>false,'message'=>'用户名不能为空'];
    return message('用户名不能为空','login');

}
//密码为空时
    if (empty($password)){
//        return ['valid'=>false,'message'=>'密码不能为空'];
        return message('密码不能为空','login');
    }
//用户名和密码都输入时 判断是否与数据库一致
//第一 查询数据库 判断是否有当前输入的用户名
    //获得数据库用户的信息数据
    $data=self::where('username','=',$username)->first();
//有当前用户时不为空 没有时为空
if (empty($data)){
//    return ['valid'=>false,'message'=>'用户名不存在'];
    return message('用户名不存在','login');
}


//当前输入的用户名存在时 验证密码
    if (!password_verify($password,$data['password'])){
//        return ['valid'=>false,'message'=>'密码错误'];
        return message('密码错误','login');
    }

    //匹配验证码是否正确
//code 为$_POST表单字段名
//     dd($code);

    if (empty($code)){

        return message('验证码为空','login');
    }

    if (!Code::auth( 'code' )){  return message('验证码错误','login');}


//用户名和密码  验证码 验证通过时 存入session    $_SESSION['username'] = $data['username'];
    Session::set('uid',$data['uid']);
    Session::set('username',$data['username']);

//返回登录成功的信息

//    return ['valid'=>true,'message'=>'欢迎,登录成功'];
    return message('欢迎登陆成功','admin/entry/index');

//echo '登录成功';


}

//修改密码的方法
    public function changePassword($data){
    //如果新密码与确认密码不一样 返回错误
        if ($data['password']!=$data['password_confirm']){
            return message('确认密码有误','refresh');
        }
//如果两次密码输入一致 进行修改 通过session获得当前登录的用户
        $user = self::find(Session::get('uid'));
//将新密码加密 存入数据库
        $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
        $user->save($data);
        return message('修改成功','refresh');
    }



}