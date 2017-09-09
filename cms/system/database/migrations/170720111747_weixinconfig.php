<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class weixinconfig extends Migration {
    //执行
	public function up() {
		Schema::create( 'weixinconfig', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string('weixinname')->comment('微信公众号名称');
            $table->string('weixin')->comment('微信号');
            $table->string('appid')->comment('appid');
            $table->string('appsecret')->comment('appsecret');
            $table->string('token')->comment('token');
            $table->string('encodingaeskey')->comment('encodingaeskey');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'weixinconfig' );
    }
}