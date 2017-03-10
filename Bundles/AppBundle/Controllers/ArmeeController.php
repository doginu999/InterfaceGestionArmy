<?php
	namespace Bundles\AppBundle\Controllers;
    use Frash\Framework\DIC\Dic;

	class ArmeeController{
		private $armee;
		private $sess_id;
		private $req_armee;

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
			$this->req_armee = $this->orm->request('Armee');
			$this->finder = $this->orm->finder();
		}

		public function aeronefAction(){
			return $this->dic->load('tel')->view('armee/aeronef.tpl', [
				'liste' => $this->req_armee->getListeMateriel('aeronef')
			]);
		}

		public function armeeAction(){
			return $this->dic->load('tel')->view('armee/armee.tpl');
		}

		public function armeMunitionAction(){
			$array1 = $this->req_armee->getListeMateriel('arme');
			$array2 = $this->req_armee->getListeMateriel('munition');

			return $this->dic->load('tel')->view('armee/arme_munition.tpl', [
				'liste' => array_merge($array1, $array2)
			]);
		}

		public function depensePerteAction(){
			return $this->dic->load('tel')->view('armee/depense_perte.tpl', [
                'liste' => $this->req_armee->getListeDepense(),
                'somme' => $this->req_armee->getSumDepense()
            ]);
		}

		public function equipementAction(){
			return $this->dic->load('tel')->view('armee/equipement.tpl', [
				'liste' => $this->req_armee->getListeMateriel('equipement')
			]);
		}

		public function immobilierAction(){
			return $this->dic->load('tel')->view('armee/immobilier.tpl', [
				'liste' => $this->req_armee->getListeImmobilier()
			]);
		}

		public function medicalAction(){
			return $this->dic->load('tel')->view('armee/medical.tpl', [
				'liste' => $this->req_armee->getListeMateriel('medical')
			]);
		}

		public function navireAction(){
			return $this->dic->load('tel')->view('armee/navire.tpl', [
				'liste' => $this->req_armee->getListeMateriel('navire')
			]);
		}

		public function organisationAction(){
			$get = $this->dic->get('get');
			$orga = (empty($get['id'])) ? 0 : $get['id'];

			$this->req_armee->defineHierarOrga($orga);

			return $this->dic->load('tel')->view('armee/organisation.tpl', [
                'orga' => $orga,
                'hierar_orga' => $this->req_armee->getHierarOrga(),
                'liste' => $this->req_armee->getListeChild($orga),
                'prefix' => $this->dic->get('prefix'),
                'lang' => $this->dic->get('lang'),
                'liste_militaire' => ($orga == 0) ? [] : $this->req_armee->getListMilit($orga),
                'materiel' => ($orga == 0) ? [] : $this->req_armee->getMaterielOrga($orga),
                'form' => [
					'start' => $this->form->init([ 'method' => 'POST', 'action' => 'create/organisation/', 'csrf' => 'yes', 'csrf_name' => 'create' ]),
                	'nom' => $this->form->text([ 'name' => 'nom', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Nom' ]),
                	'offic' => $this->form->number([ 'name' => 'officier', 'class' => 'form-control', 'placeholder' => 'ID de l\'officier', 'id' => 'id_offic' ]),
                	'select_offic' => $this->form->text([ 'id' => 'select_offic', 'class' => 'form-control', 'placeholder' => 'Nom du militaire' ]),
                	'sup' => $this->form->number([ 'name' => 'sup', 'class' => 'form-control', 'placeholder' => 'ID de la branche', 'id' => 'id_sup', 'value' => $orga ]),
                	'select_sup' => $this->form->text([ 'id' => 'select_sup', 'class' => 'form-control', 'placeholder' => 'Nom de la branche' ]),
                    'type' => $this->form->select([ [ 'name' => 'type', 'class' => 'form-control' ], $this->req_armee->getListeTypeUnite() ]),
                    'immo' => $this->form->number([ 'name' => 'immo', 'class' => 'form-control', 'placeholder' => 'ID de la propriété immobilière', 'id' => 'id_immo' ]),
                    'select_immo' => $this->form->text([ 'id' => 'select_immo', 'class' => 'form-control', 'placeholder' => 'Nom de la propriété immobilière' ]),
                	'submit' => $this->form->submit([ 'name' => 'submit', 'value' => 'Créer', 'class' => 'btn btn-default' ]),
                	'end' => '</form>'
                ],
                'form_rename' => [
                	'start' => $this->form->init([ 'method' => 'POST', 'action' => 'create/rename_orga/', 'csrf' => 'yes', 'csrf_name' => 'rename' ]),
                	'nom' => $this->form->text([ 'name' => 'nom', 'require' => true, 'class' => 'form-control', 'placeholder' => 'Nouveau nom' ]),
                	'id' => $this->form->hidden([ 'name' => 'id', 'value' => $orga ]),
                	'submit' => $this->form->submit([ 'name' => 'submit', 'value' => 'Renommer', 'class' => 'btn btn-default' ]),
                	'end' => '</form>'
                ]
            ]);
		}

		public function policeAction(){
			return $this->dic->load('tel')->view('armee/police.tpl', [
				'liste' => $this->req_armee->getListeMateriel('police')
			]);
		}

		public function ressHommeAction(){
			return $this->dic->load('tel')->view('armee/ress_homme.tpl', [
                'liste_militaire' => $this->req_armee->getListeAllMilitaire()
			]);
		}

		public function satelliteAction(){
			return $this->dic->load('tel')->view('armee/satellite.tpl', [
				'liste' => $this->req_armee->getListeMateriel('satellite')
			]);
		}

		public function utilitaireAction(){
			return $this->dic->load('tel')->view('armee/utilitaire.tpl', [
				'liste' => $this->req_armee->getListeMateriel('utilitaire')
			]);
		}

		public function vehiculeAction(){
			return $this->dic->load('tel')->view('armee/vehicule.tpl', [
				'liste' => $this->req_armee->getListeMateriel('vehicule')
			]);
		}

		public function villeAction(){
			$get = $this->dic->get('get');

			if(empty($get['id'])){
				return $this->dic->load('tel')->view('armee/ville/liste.tpl', [
					'liste' => $this->req_armee->getListeVille()
				]);
			} elseif(is_numeric($get['id'])) {
				return $this->dic->load('tel')->view('armee/ville/detail.tpl', [
					'detail' => $this->req_armee->getDetailVille($get['id']),
					'nb_employe' => $this->req_armee->getCountEmployeVille($this->finder->findOne('Ville', $get['id'])->nom)
				]);
			}
		}
	}