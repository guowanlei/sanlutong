<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class keyword extends Migration {
    //执行
	public function up() {
		Schema::create( 'keyword', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string('module')->comment('所属模型');
            $table->string('keyword')->comment('关键词内容');
            $table->string('content_id')->comment('回复内容主键');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'keyword' );
    }
}