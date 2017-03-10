<?php
	namespace Bundles\AppBundle\Entity;
	use Frash\ORM\Entity;

	class Organisation extends Entity{
		protected $id;
		protected $nom;
		protected $superieur;
		protected $responsable;
		protected $local;
		protected $materiel;
		protected $type;
		protected $sup_nom;
	}