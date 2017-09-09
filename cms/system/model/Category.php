<?php namespace system\model;
use houdunwang\model\Model;
class Category extends Model{
	//数据表
	protected $table = "category";

	//允许填充字段
	protected $allowFill = [ '*'];

	//禁止填充字段
	protected $denyFill = [ ];

	//自动验证
	protected $validate=[
		//['字段名','验证方法','提示信息',验证条件,验证时间]
        ['catname','required','请输入栏目名称',3],
        ['description','required','请输入栏目简介',3]

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

	//拿到数据库需要操作的数据  并使用框架数组增强的函数 获得树状结构
     static public function getCategory(){

         //拿到数据库数据
         $data = self::get();
        //获得树状结构图
        $data= Arr::tree($data->toArray(),'catname','cid','pid');

       return  $data;

     }
//添加栏目或是修改栏目 不能选择自己作为自己的父级栏目
public function getCategoryByCid($cid){
         //第一 自己不能选择自己做为自己的父级栏目
    //拿到数据库所有数据 与传入的$cid比对
         $data = self::getCategory();

         foreach ($data as $k=>$v){
//             if ($v['cid']==$cid){
////if成立 代表着修改的栏目与循环里的某个栏目的cid相同 不能作为自己的父级栏目
//            $data[$k]['_disabled'] = 'disabled="disabled"';
//             }else{
//                 $data[$k]['_disabled']='';
//             }
//             //第二 不能选择当前修改的子集作为父级栏目
//             //判断所有栏目数据是否为子集
//            $data[$k]['_disabled'] = Arr::isChild($data, $v['cid'], $cid, 'cid', 'pid') ? 'disabled="disabled"' : '';
//
//            if(Arr::isChild($data, $v['cid'], $cid, 'cid', 'pid')){
//                $data[$k]['_disabled'] = 'disabled="disabled"';
//            }else{
//                $data[$k]['_disabled'] = '';
//            }
             $data[$k]['_disabled'] = $v['cid'] == $cid || Arr::isChild($data, $v['cid'], $cid, 'cid', 'pid') ? 'disabled="disabled"' : '';
         }

    return $data;

}
    public function deleteCategory($cid){
        $data = $this->find($cid);
        //先获取所有栏目的数组
//        $category = $this->get()_.toArray();
        $category = self::getCategory();
        //可以删除当前模型的数据，这时的模型等同于一个新模型，模型没有与表记录进行关联。
        if(Arr::hasChild($category, $cid, 'pid')){
            //成立的话，说明有子栏目，不允许直接删除
            $this->setError(['请先删除子栏目，再来删除我吧！！哈哈哈']);
            return false;
        }
        return $data->destory();
    }


}