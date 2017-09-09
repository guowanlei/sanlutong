<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class wxcontent extends Migration {
    //执行
	public function up() {
		Schema::create( 'wxcontent', function ( Blueprint $table ) {
			$table->increments( 'id' );
            $table->string('content');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'wxcontent' );
    }
}