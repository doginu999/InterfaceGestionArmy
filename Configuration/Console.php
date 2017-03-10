<?php
namespace Configuration;

class Console{
	private static $console = [
		'default' => [
			'Bundle:generate' => 'Frash.Console.Bundle.GenerateBundle',
			'Clear:Cache' => 'Frash.Console.Files.ClearCache',
			'Controller:generate' => 'Frash.Console.Bundle.GenerateController',
			'Documentation:create' => 'Frash.Console.Documentation.DocGen',
			'Framework:init' => 'Frash.Console.Framework.Init',
			'ORM:addentity' => 'Frash.Console.ORM.Addentity',
			'ORM:createdb' => 'Frash.Console.ORM.Createdb',
			'Test:Unit:run' => 'Frash.UnitTest.CommandTest'
		],
		'custom' => [
			'armee' => 'Bundles.AppBundle.Ressources.Armee'
		]
	];

	public static function get(){
		return self::$console;
	}
}