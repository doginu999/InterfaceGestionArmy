<?php
namespace Bundles\AppBundle\Repository;
use Frash\Framework\DIC\Dic;
use Frash\ORM\PGSQL\QueryBuilder;
use Frash\ORM\PGSQL\Request\{ Insert, Update, Select };

class CreateRepository extends QueryBuilder{
	public function __construct(Dic $dic, $conn){
        parent::__construct($dic, $conn);
    }

    public function countDepense($materiel){
        $sel = new Select([ 'table' => 'depense' ]);
        $sel->setCount()->where('materiel', ':mat')->setExecute([ $materiel ]);
        return $this->selectOne($sel)->number_result;
    }

    public function insertBrancheOrga($nom, $sup_id, $sup_nom, $offic, $type, $immobilier){
        $ins = new Insert('organisation');
        $ins->setInsert([ 'nom', 'superieur', 'type', 'responsable', 'local', 'sup_nom' ]);
        $ins->setExecute([ $nom, $sup_id, $type, $offic, $immobilier, $sup_nom ]);
        return $this->insert($ins);
    }

    public function insertDepense($materiel, $nombre){
        $ins = new Insert('depense');
        $ins->setInsert([ 'materiel', 'nombre' ])->setExecute([ $materiel, $nombre ]);
        $this->insert($ins);
    }

    public function insertImmobilier($ville, $quartier, $nom){
        $ins = new Insert('immobilier');
        $ins->setInsert([ 'ville', 'quartier', 'nom' ])->setExecute([ $ville, $quartier, $nom ]);
        return $this->insert($ins);
    }

    public function insertMateriel($nom, $categorie){
        $ins = new Insert('materiel');
        $ins->setInsert([ 'nom', 'categorie' ])->setExecute([ $nom, $categorie ]);
        return $this->insert($ins);
    }

    public function insertMilitaire($nom, $prenom, $password, $age, $naissance, $solde, $specialite, $forme, $orga, $immo, $materiel, $cmdt, $orig, $grade, $sexe){
        $ins = new Insert('militaire');
        $ins->setInsert([ 'nom', 'prenom', 'password', 'age', 'naissance', 'solde', 'specialite', 'forme', 'organisation', 'immobilier', 'materiel', 'cmdt', 'origine', 'grade', 'sexe' ]);
        $ins->setExecute([ $nom, $prenom, $password, $age, $naissance, $solde, $specialite, $forme, $orga, $immo, $materiel, $cmdt, $orig, $grade, $sexe ]);
        return $this->insert($ins);
    }

    public function insertRole($role){
        $ins = new Insert('role');
        $ins->setInsert([ 'nom', 'materiel' ])->setExecute([ $role, '' ]);
        $this->insert($ins);
    }

    public function insertVille($nom, $svg){
        $ins = new Insert('ville');
        $ins->setInsert([ 'nom', 'svg' ])->setExecute([ $nom, $svg ]);
        $this->insert($ins);
    }

    public function renameOrga($id, $nom){
        $upd = new Update('organisation');
        $wh = new Where;
        $wh->where('id', ':id');
        $upd->setUpdate([ 'nom' => ':nom' ])->setWhere($wh)->setExecute([ $id, $nom ]);
        $this->update($upd);
    }

    public function updateDepense($materiel, $nombre){
        $upd = new Update('depense');
        $wh = new Where;
        $wh->where('materiel', ':mat');
        $upd->setUpdate([ 'nombre +' => ':nb' ])->setWhere($wh)->setExecute([ $materiel, $nombre ]);
        $this->update($upd);
    }

    public function updateGradeNb($grade){
        $upd = new Update('grade');
        $wh = new Where;
        $wh->where('id', ':id');
        $upd->setUpdate([ 'nombre +' => ':nb' ])->setWhere($wh)->setExecute([ $grade, 1 ]);
        $this->update($upd);
    }

    public function updateNbMateriel($materiel, $nombre){
        $upd = new Update('materiel');
        $wh = new Where;
        $wh->where('id', ':mat');
        $upd->setUpdate([ 'nombre -' => ':nb' ])->setWhere($wh)->setExecute([ $materiel, $nombre ]);
        $this->update($upd);
    }

    public function updateNbMilitImmo($immo){
        $upd = new Update('immobilier');
        $wh = new Where;
        $wh->where('id', ':id');
        $upd->setUpdate([ 'nb_employe +' => ':nb' ])->setWhere($wh)->setExecute([ $immo, 1 ]);
        $this->update($upd);
    }

    public function updateOrigineNb($orig){
        $upd = new Update('origine');
        $wh = new Where;
        $wh->where('id', ':id');
        $upd->setUpdate([ 'nombre +' => ':nb' ])->setWhere($wh)->setExecute([ $orig, 1 ]);
        $this->update($upd);
    }

    public function updateRespOrga($orga, $militaire){
        $upd = new Update('organisation');
        $wh = new Where;
        $wh->where('id', ':id');
        $upd->setUpdate([ 'responsable' => ':resp' ])->setWhere($wh)->setExecute([ $orga, $militaire ]);
        $this->update($upd);
    }

    public function updateMilitaireCmdt($militaire, $orga, $immo){
        $upd = new Update('militaire');
        $wh = new Where;
        $wh->where('id', ':id');
        $upd->setUpdate([ 'organisation' => ':orga', 'immobilier' => ':immo', 'cmdt' => ':cmdt' ])->setWhere($wh)->setExecute([ $militaire, $orga, $immo, 1 ]);
        $this->update($upd);
    }
}