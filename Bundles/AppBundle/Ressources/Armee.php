<?php
namespace Bundles\AppBundle\Ressources;
use LFW\Console\CommandInterface;
use LFW\Framework\DIC\Dic;
use LFW\Framework\FileSystem\{ File, Json };

class Armee implements CommandInterface{
	private $req;
	private $militaire = 0;

	public function __construct(array $argv){}

	public function work(){
		$dic = new Dic();
		$dic->set('bundle', 'AppBundle');

		$this->req = $dic->load('orm')->getRequest('Generation');

		$this->req->insertImmobilier(Json::decode(File::read('Bundles/AppBundle/Ressources/immobilier.json')));
		$this->req->insertMateriel(Json::decode(File::read('Bundles/AppBundle/Ressources/materiel.json')));
		$this->insert(Json::decode(File::read('Bundles/AppBundle/Ressources/armee.json')));
		$this->req->updateBranche(Json::decode(File::read('Bundles/AppBundle/Ressources/branche.json')));
		$this->req->insertMilitaire(Json::decode(File::read('Bundles/AppBundle/Ressources/militaire.json')));
		$this->req->insertDepense(Json::decode(File::read('Bundles/AppBundle/Ressources/depense.json')));

		echo 'Militaires : '.$this->militaire.PHP_EOL;
	}

	private function insert($array, $id_sup = 0, $nom_sup = 'Armée'){
		foreach($array as $k => $v){
			if(!isset($v['type_orga'])){
				echo '<h1>type_orga : '.$k.'</h1>';
			} else {
				$id = $this->req->insertOrga($k, $id_sup, $v['type_orga'], $v['immobilier'], $nom_sup);
				$immo = $v['immobilier'];
				$type_orga = $v['type_orga'];

				if(isset($v['materiel'])){
					$this->req->updMateriel($v['materiel']);
				}

				unset($v['type_orga']);
				unset($v['immobilier']);
				unset($v['materiel']);

				if(isset($v['liste_militaire'])){
					$this->militaire += $v['liste_militaire'];
					//$this->req->insertMilitaireOrga($v['liste_militaire'], $id, $immo);
					unset($v['liste_militaire']);
				} else {
					echo '<h1>liste_militaire : '.$k.'</h1>';
				}

				if(isset($v['type'])){
					$type = Json::decode(File::read('Bundles/AppBundle/Ressources/Generation/'.$v['type'].'.json'));
					unset($v['type']);
					$this->insertInf($type, $id, $k, $immo);
				} elseif(isset($v['type_special'])) {
					$type = Json::decode(File::read('Bundles/AppBundle/Ressources/Generation/Special/'.$v['type_special'].'.json'));
					unset($v['type_special']);
					$this->insertInfSpecial($type, $id_sup, $nom_sup, $k, $immo, $type_orga);
				} elseif(!empty($v)) {
					$this->insert($v, $id, $k);
				}
			}
		}
	}

	private function insertInf($array, $id_sup, $nom_sup, $immo){
		foreach($array as $k => $v){
			if($k != 'materiel' && $k != 'liste_militaire'){
				if(!isset($v['type_orga'])){
					echo '<h1>(inf) type_orga : '.$k.'</h1>';
				} else {
					$id = $this->req->insertOrga($k, $id_sup, $v['type_orga'], $immo, $nom_sup);

					if(isset($v['materiel'])){
						$this->req->updMateriel($v['materiel']);
					}

					unset($v['type_orga']);
					unset($v['materiel']);

					if(isset($v['liste_militaire'])){
						$this->militaire += $v['liste_militaire'];
						//$this->req->insertMilitaireOrga($v['liste_militaire'], $id, $immo);
						unset($v['liste_militaire']);
					} else {
						echo '<h1>(inf) liste_militaire : '.$k.'</h1>';
					}

					if(!empty($v)){
						$this->insertInf($v, $id, $k, $immo);
					}
				}
			} elseif($k == 'materiel') {
				$this->req->updMateriel($v);
			}
		}
	}

	private function insertInfSpecial($type, $id_sup, $nom_sup, $nom, $immo, $type_orga){
		$id = $this->req->insertOrga($nom, $id_sup, $type_orga, $immo, $nom_sup);

		if(isset($v['materiel'])){
			$this->req->updMateriel($v['materiel']);
		}

		unset($type['materiel']);

		if(isset($type['liste_militaire'])){
			$this->militaire += $v['liste_militaire'];
			//$this->req->insertMilitaireOrga($v['liste_militaire'], $id, $immo);
			unset($type['liste_militaire']);
		} else {
			echo '<h1>(inf_spec) liste_militaire : '.$nom.'</h1>';
		}
	}
}