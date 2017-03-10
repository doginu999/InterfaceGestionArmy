<?php
	namespace Bundles\AppBundle\Entity;
	use Frash\ORM\Entity;

	class Militaire extends Entity{
		protected $id;
		protected $nom;
		protected $prenom;
		protected $password;
		protected $age;
		protected $naissance;
		protected $solde;
		protected $specialite;
		protected $forme;
		protected $grade;
		protected $organisation;
		protected $immobilier;
		protected $mouvement;
		protected $materiel;
		protected $connexion;
		protected $cmdt;
		protected $origine;
		protected $rang;
		protected $sexe;
	}