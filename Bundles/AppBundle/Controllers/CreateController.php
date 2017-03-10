<?php
	namespace Bundles\AppBundle\Controllers;
    use Frash\Framework\DIC\Dic;

	class CreateController{
		private $sess_id;
		private $user;
		private $c;

		private $dic;
		private $counter;
		private $finder;
		private $form;
		private $orm;
		private $redirect;

		public function __construct(Dic $dic){
			$this->dic = $dic;
			$this->form = $this->dic->load('form');
			$this->redirect = $this->dic->load('redirect');

			$this->sess_id = $this->dic->load('session')->get('id');
			if($this->sess_id === false){ return $this->redirect->route('home/')->go(); }

			$this->orm = $this->dic->load('orm');
			$this->counter = $this->orm->counter();
			$this->finder = $this->orm->finder();
			$this->c = $this->orm->request('Create');
		}

		public function depenseAction(){
			$post = $this->form->getPost();

			//if($this->form->verif()->csrf($post->token, 'token')){
				$this->c->updateNbMateriel($post->materiel, $post->nombre);
				$materiel = $this->finder->findOne('Materiel', $post->materiel);

                if($this->counter->countByMateriel('Depense', $materiel->nom) == 0){
                    $this->c->insertDepense($materiel->nom, $post->nombre);
                } else {
                    $this->c->updateDepense($materiel->nom, $post->nombre);
                }
			//}

			return $this->redirect->route('admin/add_depense/')->go();
		}

		public function immobilierAction(){
			$post = $this->form->getPost();

			//if($this->form->verif()->csrf($post->token, 'token')){
				$quartier = (strlen($post->quartier) > 0) ? $post->quartier : '';
				$this->c->insertImmobilier($post->ville, $quartier, $post->nom);
			//}

			return $this->redirect->route('admin/add_immo/')->go();
		}

		public function materielAction(){
			$post = $this->form->getPost();

			//if($this->form->verif()->csrf($post->token, 'token')){
				$this->c->insertMateriel($post->nom, $post->categorie);
			//}

			return $this->redirect->route('admin/add_materiel/')->go();
		}

		public function militaireAction(){
			$post = $this->form->getPost();

			//if($this->form->verif()->csrf($post->token, 'token') && $post->offic != 'vide'){
				$date = $this->finder->findOneByParam('Config', 'date')->value;
				$immo = $this->finder->findOne('Organisation', $post->orga)->local;
				$materiel = $this->finder->findOne('Role', $post->role)->materiel;
				$solde = $this->finder->findOne('Grade', $post->grade)->solde;

				$militaire = $this->c->insertMilitaire($post->nom, $post->prenom, sha1($post->password), $this->calculAge(str_replace('/', '-', $post->naissance), $date), $post->naissance, $solde, $post->role, $post->ecole, $post->orga, $immo, $materiel, $post->offic, $post->origine, $post->grade, $post->sexe);
				$this->c->updateOrigineNb($post->origine);
				$this->c->updateGradeNb($post->grade);

				if($post->offic == 1){
					$this->c->updateRespOrga($post->orga, $militaire);
				}

				if($immo > 0){
					$this->c->updateNbMilitImmo($immo);
				}

				return $this->redirect->route('admin/')->go();
			//}

			return $this->redirect->route('admin/add_militaire/')->go();
		}

		public function organisationAction(){
			$post = $this->form->getPost();

			//if($this->form->verif()->csrf($post->create, 'create')){
				$nom_sup = $this->finder->findOne('Organisation', $post->sup)->nom;

				$id = $this->c->insertBrancheOrga($post->nom, $post->sup, $nom_sup, $post->officier, $post->type, $post->immo);
				$this->c->updateMilitaireCmdt($post->officier, $id, $post->immo);
				return $this->redirect->route('armee/organisation/'.$id.'/')->go();
			//}

			return $this->redirect->route('armee/organisation/')->go();
		}

		public function renameOrgaAction(){
			$post = $this->form->getPost();

			//if($this->form->verif()->csrf($post->token, 'token')){
				$this->c->renameOrga($post->id, $post->nom);
			//}
			
			return $this->redirect->route('armee/organisation/'.$post->id.'/')->go();
		}

		public function roleAction(){
			$post = $this->form->getPost();

			//if($this->form->verif()->csrf($post->token, 'token')){
				$this->c->insertRole($post->role);
			//}

			return $this->redirect->route('admin/add_role/')->go();
		}

		public function villeAction(){
			$post = $this->form->getPost();

			//if($this->form->verif()->csrf($post->token, 'token')){
				$this->c->insertVille($post->ville, $post->svg);
			//}

			return $this->redirect->route('admin/add_ville/')->go();
		}

		private function calculAge($naissance, $date){
			$arr1 = explode('-', $naissance);
			$arr2 = explode('-', $date);
				
			if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0]))){
				return $arr2[2] - $arr1[2];
			}

			return $arr2[2] - $arr1[2] - 1;
		}
	}