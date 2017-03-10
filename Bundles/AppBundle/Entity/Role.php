<?php
	namespace Bundles\AppBundle\Entity;
	use Frash\ORM\Entity;

	class Role extends Entity{
		protected $id;
		protected $nom;
		protected $materiel;
	}