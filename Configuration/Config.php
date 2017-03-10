<?php
namespace Configuration;

class Config{
	private static $config = [
		'env' => 'local',
		'analyzer' => 'yes',
		'racine' => 'home',
		'cache' => [
			'memcached' => [
				'localhost' => '11211'
			],
			'tpl' => 'yes'
		],
		'traduction' => [
			'default' => 'fr',
			'available' => [ 'fr' ]
		],
		'log' => [
			'access' => 'no',
			'ajax' => 'no',
			'error' => 'yes',
			'request' => 'yes'
		]
	];

	public static function get(){
		return self::$config;
	}
}