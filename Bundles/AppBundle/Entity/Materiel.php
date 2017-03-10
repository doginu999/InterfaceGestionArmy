<?php
	namespace Bundles\AppBundle\Entity;
	use Frash\ORM\Entity;

	class Materiel extends Entity{
		protected $id;
		protected $nom;
		protected $nombre;
		protected $use;
		protected $categorie;
		protected $value;
	}