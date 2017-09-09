<?php namespace system\model;
use houdunwang\model\Model;
class Article extends Model{
	//数据表
	protected $table = "article";

	//允许填充字段
	protected $allowFill = [ '*'];

	//禁止填充字段
	protected $denyFill = [ ];

	//自动验证
	protected $validate=[
		//['字段名','验证方法','提示信息',验证条件,验证时间]
        ['title','required','请输入栏目名称',3],
        ['description','required','请输入栏目简介',3],
        ['content','required','请输入栏目名称',3],
        ['source','required','请输入栏目简介',3]

	];

	//自动完成
	protected $auto=[
		//['字段名','处理方法','方法类型',验证条件,验证时机]

        ['ishot','否','string', self::NOT_EXIST_AUTO ,    self::MODEL_BOTH ],
        ['iscommend','否','string', self::NOT_EXIST_AUTO ,    self::MODEL_BOTH ],

	];

	//自动过滤
    protected $filter=[
        //[表单字段名,过滤条件,处理时间]
    ];

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps=false;


	 static  public function getArticle(){

         //拿到数据库所有文章数据
         //还要拿到数据库栏目列表的数据
         //文章表与栏目表关联 得到每篇文章所属的栏目
         //field获得指定字段的方法
         //->paginate(3)获得分页管理
         $data = Article::field('article.*,category.catname')->join('category','article.categorycid','=','category.cid')->paginate(v('config')['article_row']);

         return  $data;

     }


//删除文章的方法
    public function deleteArticle($cid){
        $data = $this->find($cid);

        return $data->destory();
    }
















}