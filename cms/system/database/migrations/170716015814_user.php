<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class user extends Migration {
    //执行
	public function up() {
		Schema::create( 'user', function ( Blueprint $table ) {
			$table->increments( 'uid' );
            $table->timestamps();
            $table->char('username', 30);
            $table->char('password', 40);


        });
    }

    //回滚
    public function down() {
        Schema::drop( 'user' );
    }
}