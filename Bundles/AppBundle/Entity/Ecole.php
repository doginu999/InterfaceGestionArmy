<?php
	namespace Bundles\AppBundle\Entity;
	use Frash\ORM\Entity;

	class Ecole extends Entity{
		protected $id;
		protected $nom;
		protected $ville;
		protected $immobilier;
	}