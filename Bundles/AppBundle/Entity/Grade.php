<?php
	namespace Bundles\AppBundle\Entity;
	use Frash\ORM\Entity;

	class Grade extends Entity{
		protected $id;
		protected $nom;
		protected $solde;
		protected $nombre;
	}