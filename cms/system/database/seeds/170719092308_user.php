<?php namespace system\database\seeds;
use houdunwang\database\build\Seeder;
use houdunwang\db\Db;
class user extends Seeder {
    //执行
	public function up() {
		//Db::table('news')->insert(['title'=>'后盾人']);
        Db::table('user')->insert(['username'=>'郭万磊','password'=>password_hash('8888',PASSWORD_DEFAULT)]);
        Db::table('user')->insert(['username'=>'admin','password'=>password_hash('admin',PASSWORD_DEFAULT)]);


    }
    //回滚
    public function down() {

    }
}