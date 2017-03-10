<?php
	namespace Bundles\AppBundle\Entity;
	use Frash\ORM\Entity;

	class Config extends Entity{
		protected $id;
		protected $param;
		protected $value;
	}