<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class sousuo extends Migration {
    //执行
	public function up() {
		Schema::create( 'sousuo', function ( Blueprint $table ) {
			$table->increments( 'id' );
            $table->timestamps();
            $table->string('keyword', 100);
            $table->integer('sousuo_num');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'sousuo' );
    }
}