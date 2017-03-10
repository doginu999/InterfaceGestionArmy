<?php
	namespace Bundles\AppBundle\Entity;
	use Frash\ORM\Entity;

	class Immobilier extends Entity{
		protected $id;
		protected $ville;
		protected $quartier;
		protected $nom;
		protected $prix;
		protected $nb_employe;
	}