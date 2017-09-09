<?php
namespace module\wx\system;
use module\wx\model\Keyword;
use module\wx\model\Wxcontent;
use module\Hdprocessor;
use houdunwang\wechat\WeChat;
class Processor extends Hdprocessor
{
    //动作
    public function index($id){

//        //通过传过来的keyword表的主键id找到这条关键字的数据
       $keyword = Keyword::find($id);
//获得要回复给用户的内容
        $reply = Wxcontent::find($keyword['content_id']);

        //实例化消息模块
        $instance = WeChat::instance('message');

        $instance->text($reply['content']);

    }
}