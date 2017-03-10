<?php
	namespace Bundles\AppBundle\Controllers;
    use Frash\Framework\DIC\Dic;
    use Bundles\AppBundle\Controllers\AjaxController;

	class AdminController{
		private $armee;
		private $sess_id;
		private $user;
		private $req_admin;

		private $dic;
		private $finder;
		private $form;
		private $orm;
		private $redirect;

		public function __construct(Dic $dic){
			$this->dic = $dic;
			$this->form = $this->dic->load('form')->create();
			$this->redirect = $this->dic->load('redirect');

			$this->sess_id = $this->dic->load('session')->get('id');
            if($this->sess_id === false){ return $this->redirect->route('home/')->go(); }

			$this->orm = $this->dic->load('orm');
			$this->req_admin = $this->orm->request('Admin');
			$this->finder = $this->orm->finder();
            $this->user = $this->finder->findOne('Militaire', $this->sess_id);
		}

		public function adminAction(){
			return $this->dic->load('tel')->view('admin/admin.tpl');
		}

		public function addDepenseAction(){
			return $this->dic->load('tel')->view('admin/add_depense.tpl', [
				'form' => [
					'start' => $this->form->init([ 'method' => 'POST', 'action' => 'create/depense/' ]),
					'materiel' => $this->form->select([ [ 'name' => 'materiel', 'class' => 'form-control' ], $this->req_admin->getListeMateriel() ]),
                    'nombre' => $this->form->number([ 'name' => 'nombre', 'require' => true, 'placeholder' => 'Nombre', 'class' => 'form-control' ]),
                    'submit' => $this->form->submit([ 'name' => 'submit', 'value' => 'Enregistrer', 'class' => 'btn btn-default' ]),
                    'end' => '</form>'
				]
			]);
		}

		public function addImmoAction(){
			return $this->dic->load('tel')->view('admin/add_immo.tpl', [
				'form' => [
					'start' => $this->form->init([ 'method' => 'POST', 'action' => 'create/immobilier/' ]),
					'ville' => $this->form->text([ 'name' => 'ville', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Ville' ]),
					'quartier' => $this->form->text([ 'name' => 'quartier', 'class' => 'form-control', 'placeholder' => 'Quartier' ]),
					'nom' => $this->form->text([ 'name' => 'nom', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Nom de la propriété', ]),
					'submit' => $this->form->submit([ 'name' => 'submit', 'value' => 'Enregistrer', 'class' => 'btn btn-default' ]),
                    'end' => '</form>'
				]
			]);
		}

		public function addMaterielAction(){
			return $this->dic->load('tel')->view('admin/add_materiel.tpl', [
				'form' => [
					'start' => $this->form->init([ 'method' => 'POST', 'action' => 'create/materiel/' ]),
					'nom' => $this->form->text([ 'name' => 'nom', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Nom' ]),
					'categorie' => $this->form->select([ [ 'name' => 'categorie', 'class' => 'form-control' ], [
						'aeronef' => 'Aéronef', 'vehicule' => 'Véhicule', 'navire' => 'Navire', 'arme' => 'Arme', 'munition' => 'Munition',
						'entretien' => 'Entretien', 'utilitaire' => 'Utilitaire', 'equipement' => 'Equipement', 'police' => 'Police',
						'satellite' => 'Satellite', 'medical' => 'Médical'
					] ]),
					'submit' => $this->form->submit([ 'name' => 'submit', 'value' => 'Enregistrer', 'class' => 'btn btn-default' ]),
					'end' => '</form>'
				]
			]);
		}

		public function addMilitaireAction(){
			return $this->dic->load('tel')->view('admin/add_militaire.tpl', [
                'prefix' => $this->dic->get('prefix'),
                'form' => [
                	'start' => $this->form->init([ 'method' => 'POST', 'action' => 'create/militaire/' ]),
                	'nom' => $this->form->text([ 'name' => 'nom', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Nom' ]),
                	'prenom' => $this->form->text([ 'name' => 'prenom', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Prénom' ]),
                	'password' => $this->form->password([ 'name' => 'password', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Password', 'id' => 'password_input' ]),
                	'naissance' => $this->form->text([ 'name' => 'naissance', 'class' => 'form-control', 'placeholder' => 'Naissance : DD-MM-YYYY' ]),
                    'role' => $this->form->select([ [ 'name' => 'role', 'class' => 'form-control' ], $this->req_admin->getListeRole() ]),
                    'ecole' => $this->form->select([ [ 'name' => 'ecole', 'class' => 'form-control' ], $this->req_admin->getListeEcole() ]),
                	'orga' => $this->form->number([ 'name' => 'orga', 'class' => 'form-control', 'placeholder' => 'ID de la branche', 'id' => 'id_sup' ]),
                	'select_orga' => $this->form->text([ 'id' => 'select_sup', 'class' => 'form-control', 'placeholder' => 'Nom de la branche' ]),
                    'offic' => $this->form->select([ [ 'name' => 'offic', 'class' => 'form-control' ], [ 'vide' => 'Est-il l\'officier', 0 => 'Non', 1 => 'Oui' ] ]),
                    'orig' => $this->form->select([ [ 'name' => 'origine', 'class' => 'form-control' ], $this->req_admin->getListeOrigine() ]),
                    'grade' => $this->form->select([ [ 'name' => 'grade', 'class' => 'form-control' ], $this->req_admin->getListeGrade() ]),
                    'sexe' => $this->form->select([ [ 'name' => 'sexe', 'class' => 'form-control' ], [ 'M' => 'Homme', 'F' => 'Femme' ] ]),
                	'submit' => $this->form->submit([ 'name' => 'submit', 'value' => 'Enregistrer', 'class' => 'btn btn-default' ]),
                	'end' => '</form>'
                ]
            ]);
		}

		public function addRoleAction(){
			return $this->dic->load('tel')->view('admin/add_role.tpl', [
				'form' => [
					'start' => $this->form->init([ 'method' => 'POST', 'action' => 'create/role/' ]),
					'role' => $this->form->text([ 'name' => 'role', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Rôle' ]),
                	'submit' => $this->form->submit([ 'name' => 'submit', 'value' => 'Enregistrer', 'class' => 'btn btn-default' ]),
                	'end' => '</form>'
				]
			]);
		}

		public function addVilleAction(){
			return $this->dic->load('tel')->view('admin/add_ville.tpl', [
				'form' => [
					'start' => $this->form->init([ 'method' => 'POST', 'action' => 'create/ville/' ]),
					'ville' => $this->form->text([ 'name' => 'ville', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Ville' ]),
					'svg' => $this->form->text([ 'name' => 'svg', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Nom SVG' ]),
                	'submit' => $this->form->submit([ 'name' => 'submit', 'value' => 'Enregistrer', 'class' => 'btn btn-default' ]),
                	'end' => '</form>'
				]
			]);
		}
	}