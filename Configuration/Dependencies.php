<?php
namespace Configuration;

class Dependencies{
	private static $dependencies = [
		'analyzer' => 'Frash.Framework.Analyzer.Analyzer',
		'controller' => 'Frash.Framework.Controller.Controller',
		'form' => 'Frash.Framework.Forms.FormFactory',
		'getUrl' => 'Frash.Framework.Controller.GetUrl',
		'mail' => 'Frash.Framework.Mail.Mailer',
		'memcached' => 'Frash.Framework.Cache.MemCache',
		'microtime' => 'Frash.Framework.Utility.Microtime',
		'orm' => 'Frash.ORM.OrmFactory',
		'redirect' => 'Frash.Framework.Request.Redirect',
		'response' => 'Frash.Framework.Request.Response',
		'route' => 'Frash.Framework.Routing.Router',
		'service' => 'Frash.Framework.Request.Service',
		'session' => 'Frash.Framework.Request.Session',
		'trad' => 'Frash.Framework.Controller.TraductionFactory',
		'twig' => 'Frash.Framework.Controller.View',
		'tel' => 'Frash.Framework.Controller.Templating'
	];

	public static function get(){
		return self::$dependencies;
	}
}