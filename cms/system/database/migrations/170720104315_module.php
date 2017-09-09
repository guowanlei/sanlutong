<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class module extends Migration {
    //执行
	public function up() {
		Schema::create( 'module', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string('name')->comment('模块标识');
            $table->string('title')->comment('模块名称');
            $table->string('author')->comment('模块作者');
            $table->string('description')->comment('模块介绍');
            $table->string('preview')->comment('预览图片');
            $table->string('is_weixin')->comment('是否处理微信');
            $table->string('is_system')->comment('是否为系统模块');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'module' );
    }
}