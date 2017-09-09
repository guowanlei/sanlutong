<?php
/**
 * Created by PhpStorm.
 * User: gwl
 * Date: 2017/7/25
 * Time: 8:58
 */

namespace module;


use module\wx\model\Keyword;

class Hdprocessor
{
//获得要回复给用户的内容的content_id
   public function getContentById($id){
//通过用户输入的信息匹配到关键字获得数据库这一条关键字的数据
//获得关键字的id找到要回复给用户内容content_id
           $content_id = Keyword::where('id','=',$id)->pluck('content_id');
     return  $content_id;
   }

}