<?php
namespace Configuration;

class Database{
	private static $database = [
		'AppBundle' => [
			'host' => 'localhost',
			'username' => '',
			'password' => '',
			'dbname' => '',
			'system' => 'PGSQL',
			'port' => '5432'
		]
	];

	public static function get(){
		return self::$database;
	}
}