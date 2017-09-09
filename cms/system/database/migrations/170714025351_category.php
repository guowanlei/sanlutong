<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class category extends Migration {
    //执行
	public function up() {
		Schema::create( 'category', function ( Blueprint $table ) {
			$table->increments( 'id' );
            $table->timestamps();
            $table->string('catname');
            $table->text('description');
            $table->tinyInteger('orderby');
            $table->integer('pid');

        });
    }

    //回滚
    public function down() {
        Schema::drop( 'category' );
    }
}