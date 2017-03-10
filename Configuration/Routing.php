<?php
namespace Configuration;
use Frash\Framework\Routing\TreatmentPhp;

class Routing extends TreatmentPhp
{
	public function __construct()
	{
		$this->group([ 'bundle' => 'AppBundle' ], function(){
			$this->group([ 'middleware' => 'Connected' ], function(){
				$this->group([ 'middleware' => 'Admin' ], function(){
					$this->get('admin', 'AdminController:adminAction');
					$this->get('admin/add_depense', 'AdminController:addDepenseAction');
					$this->get('admin/add_immo', 'AdminController:addImmoAction');
					$this->get('admin/add_materiel', 'AdminController:addMaterielAction');
					$this->get('admin/add_militaire', 'AdminController:addMilitaireAction');
					$this->get('admin/add_role', 'AdminController:addRoleAction');
					$this->get('admin/add_ville', 'AdminController:addVilleAction');
				});

				$this->get('armee', 'ArmeeController:armeeAction');
				$this->get('armee/depense_perte', 'ArmeeController:depensePerteAction');
				$this->get('armee/militaire/:id', 'ArmeeController:militaireAction', [ 'get' => [ 'id' => [ 'type' => 'integer' ]]]);
				$this->get('armee/organisation/:id?', 'ArmeeController:organisationAction', [ 'get' => [ 'id' => [ 'type' => 'integer' ]]]);
				$this->get('armee/ressources_humaines', 'ArmeeController:ressHommeAction');
				$this->get('armee/ressources/aeronef', 'ArmeeController:aeronefAction');
				$this->get('armee/ressources/arme_munition', 'ArmeeController:armeMunitionAction');
				$this->get('armee/ressources/immobilier', 'ArmeeController:immobilierAction');
				$this->get('armee/ressources/medical', 'ArmeeController:medicalAction');
				$this->get('armee/ressources/navire', 'ArmeeController:navireAction');
				$this->get('armee/ressources/police', 'ArmeeController:policeAction');
				$this->get('armee/ressources/satellite', 'ArmeeController:satelliteAction');
				$this->get('armee/ressources/utilitaire', 'ArmeeController:utilitaireAction');
				$this->get('armee/ressources/vehicule', 'ArmeeController:vehiculeAction');
				$this->get('armee/ville/:id?', 'ArmeeController:villeAction', [ 'get' => [ 'id' => [ 'type' => 'integer' ]]]);
				$this->get('interface', 'InterfaceController:interfaceAction');
				$this->get('statistique', 'StatsController:statsAction');

				$this->post('create/depense', 'CreateController:depenseAction');
				$this->post('create/immobilier', 'CreateController:immobilierAction');
				$this->post('create/materiel', 'CreateController:materielAction');
				$this->post('create/militaire', 'CreateController:militaireAction');
				$this->post('create/organisation', 'CreateController:organisationAction');
				$this->post('create/rename_orga', 'CreateController:renameOrgaAction');
				$this->post('create/role', 'CreateController:roleAction');
				$this->post('create/ville', 'CreateController:villeAction');
			});

			$this->get('deconnexion', 'IndexController:deconnexionAction');
			$this->get('home', 'IndexController:indexAction');

			$this->post('connexion', 'IndexController:connexionAction');

			$this->post('ajax/gener_password', 'AjaxController:generPasswordAction');
			$this->post('ajax/select_immo', 'AjaxController:selectImmoAction');
			$this->post('ajax/select_offic', 'AjaxController:selectOfficAction');
			$this->post('ajax/select_sup', 'AjaxController:selectSupAction');
		});
	}
}