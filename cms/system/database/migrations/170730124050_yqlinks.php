<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class yqlinks extends Migration {
    //执行
	public function up() {
		Schema::create( 'yqlinks', function ( Blueprint $table ) {
			$table->increments( 'id' );
            $table->timestamps();
            $table->string('title', 100);
            $table->string('url', 100);
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'yqlinks' );
    }
}