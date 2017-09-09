<?php
namespace module\article\system;

use module\wx\model\Keyword;
use system\model\Article;

class Processor
{
    //动作
    public function index($id){
//通过与用户匹配成功输入的关键字的id 找到数据库具体的关键字数据
              $contentid = Keyword::find($id);
//用关键字的数据获得 回复给用户内容所对应的content_id 获得对应的文章内容
          $article = Article::find($contentid['content_id']);

        $instance = WeChat::instance('message');

        //向用户回复消息
        $news = array(
            array(
                'title' => $article['title'],
                'discription' => $article['description'],
                'picurl' => __ROOT__ . '/'. $article['thumb'],
                'url' => __ROOT__ .'/'. '?s=home/entry/content&id=' . $article['aid']
            ),
        );
        $instance->news($news);

    }
}