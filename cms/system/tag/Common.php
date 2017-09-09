<?php namespace system\tag;
use houdunwang\view\build\TagBase;

class Common extends TagBase {
	/**
	 * 标签声明
	 * @var array
	 */
	public $tags = [
             'next' => [ 'block' => false ],
            'prev' => [ 'block' => false ],
			'line' => [ 'block' => false ],
			'tag'  => [ 'block' => true, 'level' => 4 ],
            'category'  => [ 'block' => true, 'level' => 4 ],
          'flash'  => [ 'block' => true, 'level' => 4 ],
        'article'  => [ 'block' => true, 'level' => 4 ],
        'content'  => [ 'block' => true, 'level' => 4 ],

	];
	//line 标签
	public function _line( $attr, $content, &$view ) {
		return 'link标签 测试内容';
	}

	//tag 标签
	public function _tag( $attr, $content, &$view ) {
		return 'tag标签 测试内容';
	}

//category 标签
    public function _category( $attr, $content, &$view ) {

//
//                 * 测试标签
//                 * @param $attr 标签属性集合
//                * @param $content 标签嵌套内容，块标签才有值
//                * @param $view 视图服务对象
              $pid = isset($attr['pid'])?$attr['pid']:-1;
              $cid = isset($attr['cid']) ? $attr['cid'] : 0;

//定界符
            $str = <<<str
            <?php 
            \$db =  Db::table('category');
          
        if($pid >= 0){
            \$db->where('pid',$pid);
        }
        if($cid > 0){
            \$db->where('cid',$cid);
        }
        \$category = \$db->limit(11)->get();
      foreach(\$category as \$key => \$v){ 
        \$v['url'] = __ROOT__ . '/' . '?s=home/entry/lists&cid=' . \$v['cid'];
        ?>
        $content
        <?php } ?>

str;
        return $str;
    }

//flash 标签
    public function _flash( $attr, $content, &$view ) {
         $str = <<<str
         <?php 
         \$flash = Db::table('flash')->get();
         foreach(\$flash as \$key => \$v){
        \$v['thumb'] = __ROOT__ . '/' . \$v['thumb'];
        \$v['url'] = __ROOT__ . '/' . '?s=home/entry/content&aid=' . \$v['article_aid'];
        ?>
        $content
        <?php } ?>
str;
        return $str;
    }


    //article 标签
    public function _article( $attr, $content, &$view ) {
        $categorycid = isset($attr['categorycid']) ? $attr['categorycid'] : -1;
        $isthumb = isset($attr['isthumb']) ? $attr['isthumb'] : -1;

          $str = <<<str
<?php
        \$db = Db::table('article');
        if($categorycid > 0){
            \$db->where('categorycid',$categorycid);
        }
        if($isthumb == 1){
            \$db->where('thumb','!=','');
        }
        \$article = \$db->get();
        foreach(\$article as \$key => \$value){
        \$value['thumb'] = __ROOT__ . '/' . \$value['thumb'];
        \$value['url'] = __ROOT__ . '/' . '?s=home/entry/content&aid=' . \$value['aid'];
        ?>
        $content
        <?php } ?>

str;
        return $str;
    }
    //content标签
    public function _content($attr, $content, &$view){
        $aid = isset($attr['aid']) ? $attr['aid'] : -1;
        $str = <<<str
		<?php
        \$db = Db::table('article');
        if($aid > 0){
            \$db->where('aid',$aid);
        }
        \$article = \$db->first();
        \$arccategory = Db::table('category')->where('cid',\$article['categorycid'])->first();
        ?>
        $content
str;
        return $str;
    }

//上一篇标签
    public function _prev($attr, $content, &$view){
        $aid = isset($attr['aid']) ? $attr['aid'] : -1;
        $str = <<<str
		<?php
        \$article = Db::table('article')->where('aid',$aid)->first();
        \$isset = Db::table('article')->where('aid','<',$aid)->orderBy('aid','DESC')->first();
        if(\$isset){
            \$url = __ROOT__ . "/?s=home/entry/content&aid={\$isset['aid']}";
             echo "<a href='".\$url."'>".\$isset['title']."</a>";
        }else{
            echo "<span>没有上一篇了</span>";
        }
        ?>
str;
        return $str;
    }


    //下一篇标签

    public function _next($attr, $content, &$view){
        $aid = isset($attr['aid']) ? $attr['aid'] : -1;
       $str = <<<str
          <?php
        \$article = Db::table('article')->where('aid',$aid)->first();
         \$isset = Db::table('article')->where('aid','>',$aid)->first();
           if(\$isset){
            \$url = __ROOT__ . "/?s=home/entry/content&aid={\$isset['aid']}";
             echo "<a href='".\$url."'>".\$isset['title']."</a>";
        }else{
            echo "<span>没有下一篇了</span>";
        }
        ?>
str;
     return   $str;
    }


}