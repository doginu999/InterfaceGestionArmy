<?php
namespace Bundles\AppBundle\Repository;
use Frash\Framework\DIC\Dic;
use Frash\ORM\PGSQL\QueryBuilder;
use Frash\ORM\PGSQL\Request\{ Insert, Select, Update, Where };

class GenerationRepository extends QueryBuilder{
    public function __construct(Dic $dic, $conn){
        parent::__construct($dic, $conn);
    }

    public function insertMateriel($array){
        foreach($array as $type => $materiel){
            foreach($materiel as $name => $value){
                $ins = new Insert('materiel');
                $ins->setInsert([ 'nom', 'categorie', 'value' ])->setExecute([ $name, $type, $value ]);
                $this->insert($ins);
            }
        }
    }

    public function updMateriel(array $materiel){
        foreach($materiel as $nom => $nombre){
            $upd = new Update('materiel');
            $wh = new Where;
            $wh->where('nom', ':nom');
            $upd->setUpdate([ 'nombre +' => ':nombre', 'use +' => ':use' ])->setWhere($wh)->setExecute([ $nom, $nombre, $nombre ]);
            $this->update($upd);
        }
    }

    public function insertOrga($nom, $superieur, $type, $immobilier, $sup_nom){
        $ins = new Insert('organisation');
        $ins->setInsert([ 'nom', 'superieur', 'type', 'responsable', 'local', 'sup_nom' ]);
        $ins->setExecute([ $nom, $superieur, $type, 0, $immobilier, $sup_nom ]);
        return $this->insert($ins);
    }

    public function insertMilitaireOrga($liste, $orga, $immo){
        for($i = 1; $i <= $liste['nb']; $i++){
            $ins = new Insert('militaire');
            $ins->setInsert([ 'nom', 'prenom', 'age', 'naissance', 'solde', 'organisation', 'immobilier', 'cmdt', 'origine', 'grade', 'sexe' ]);

            $ins->setExecute([
                $liste['nom'], $liste['prenom'], $liste['age'], $liste['naissance'], $liste['solde'],
                $orga, $immo, $liste['cmdt'], $liste['origine'], $liste['grade'], $liste['sexe']
            ]);

            $this->insert($ins);
        }
    }

    public function insertMilitaire(array $liste){
        foreach($liste as $id => $param){
            $orga = $this->listeOrga($param['orga']);

            $ins = new Insert('militaire');
            $ins->setInsert([ 'nom', 'prenom', 'age', 'naissance', 'solde', 'organisation', 'immobilier', 'cmdt', 'specialite', 'origine', 'grade', 'sexe' ]);

            $ins->setExecute([
                $param['nom'], $param['prenom'], $param['age'], $param['naissance'], $param['solde'], $orga->id, $orga->immo, $param['cmdt'], 
                $param['specialite'], $param['origine'], $param['grade'], $param['sexe']
            ]);

            $upd = new Update('grade');
            $wh = new Where;
            $wh->where('id', ':id');
            $upd->setUpdate([ 'nombre +' => ':nombre' ])->setWhere($wh)->setExecute([ $param['grade'], 1 ]);
            $this->update($upd);

            $upd = new Update('origine');
            $wh = new Where;
            $wh->where('id', ':id');
            $upd->setUpdate([ 'nombre +' => ':nombre' ])->setWhere($wh)->setExecute([ $param['origine'], 1 ]);
            $this->update($upd);

            $upd = new Update('immobilier');
            $wh = new Where;
            $wh->where('id', ':id');
            $upd->setUpdate([ 'nb_employe +' => ':nb_employe' ])->setWhere($wh)->setExecute([ $orga->immo, 1 ]);
            $this->update($upd);

            $id = $this->insert($ins);

            if($param['cmdt'] == 1){
                $upd = new Update('organisation');
                $wh = new Where;
                $wh->where('id', ':id');
                $upd->setUpdate([ 'responsable' => ':resp' ])->setWhere($wh)->setExecute([ $orga->id, $id ]);
                $this->update($upd);
            }
        }
    }

    private function listeOrga(string $orga){
        if(strstr($orga, '/')){
            $orgas = explode('/', $orga);
            $count = count($orgas) - 1;

            $nom_sup = 'Armée';
            $immo = 0;
            $id = 0;

            for($i = 0; $i <= $count; $i++){
                $info = $this->getOrga($orgas[ $i ], $nom_sup);
                $nom_sup = $info->nom;
                $immo = $info->local;
                $id = $info->id;

                if($i == $count){
                    return (object) [ 'id' => $id, 'nom' => $nom_sup, 'immo' => $immo ];
                }
            }
        } else {
            $sel = new Select([ 'table' => 'organisation' ]);
            $sel->where('nom', ':nom')->setExecute([ $orga ]);
            $data = $this->selectOne($sel);
            return (object) [ 'id' => $data->id, 'nom' => $data->nom, 'immo' => $data->local ];
        }
    }

    private function getOrga(string $tree, string $nom_sup){
        $sel = new Select([ 'table' => 'organisation' ]);
        $sel->where('sup_nom', ':sup_nom')->andWhere('nom', ':nom')->setExecute([ $nom_sup, $tree ]);
        return $this->selectOne($sel);
    }
}