<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class article extends Migration {
    //执行
	public function up() {
		Schema::create( 'article', function ( Blueprint $table ) {
			$table->increments( 'id' );
            $table->timestamps();
            $table->text('title');
            $table->mediumint('click');
            $table->text('description');
            $table->text('content');
            $table->string('source', 100);
             $table->string('author', 100);
            $table->smallint('orderby');
            $table->char('linkurl', 60);
            $table->char('keywrods', 30);
            $table->enum('iscommend', ['是', '否']);
            $table->enum('ishot', ['是', '否']);


        });
    }

    //回滚
    public function down() {
        Schema::drop( 'article' );
    }
}