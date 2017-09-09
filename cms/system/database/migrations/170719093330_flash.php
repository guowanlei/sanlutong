<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class flash extends Migration {
    //执行
	public function up() {
		Schema::create( 'flash', function ( Blueprint $table ) {
            $table->increments( 'fid' );
            $table->string('thumb');
            $table->integer('article_aid');
            $table->string('description');
            $table->tinyInteger('orderby');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'flash' );
    }
}