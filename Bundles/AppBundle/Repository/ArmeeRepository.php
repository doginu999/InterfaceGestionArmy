<?php
namespace Bundles\AppBundle\Repository;
use Frash\Framework\DIC\Dic;
use Frash\ORM\PGSQL\QueryBuilder;
use Frash\ORM\PGSQL\Request\Select;

class ArmeeRepository extends QueryBuilder{
    private $hierar_orga = [];
    private $somme_dep;

	public function __construct(Dic $dic, $conn){
        parent::__construct($dic, $conn);
    }

    public function getHierarOrga(){
        return array_reverse($this->hierar_orga);
    }

    public function defineHierarOrga($orga){
        if($orga > 0){
            $sel = new Select([ 'table' => 'organisation' ]);
            $sel->where('id', ':id')->setExecute([ $orga ]);
            $data = $this->selectOne($sel);

            if($data->superieur > 0){
                $this->hierar_orga[] = [ 'id' => $data->superieur, 'nom' => $data->sup_nom ];
                $this->defineHierarOrga($data->superieur);
            }
        }
    }

    public function getListeChild($sup){
    	$sel = new Select([ 'table' => 'organisation', 'order' => 'nom ASC' ]);
        $sel->where('superieur', ':sup')->setExecute([ $sup ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
        	$array[] = [
                'id' => $v->id,
                'nom' => $v->nom,
                'local' => ($v->local == 0) ? '' : $this->getInfoLocal($v->local),
                'resp' => ($v->responsable == 0) ? [ 'id' => '', 'ident' => '' ] : $this->getRespOrga($v->responsable)
            ];
        }

        return $array;
    }

    public function getListeImmobilier(){
        $sel = new Select([ 'table' => 'immobilier', 'order' => 'nom ASC' ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $array[] = [
                'id' => $v->id,
                'nom' => $v->nom,
                'ville' => $v->ville,
                'id_ville' => $this->getIdVille($v->ville),
                'quartier' => $v->quartier,
                'nb_employe' => $v->nb_employe
            ];
        }

        return $array;
    }

    public function getListeVille(){
        $sel = new Select([ 'table' => 'ville', 'order' => 'nom ASC' ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $array[] = [
                'id' => $v->id,
                'nom' => $v->nom,
                'svg' => $v->svg
            ];
        }

        return $array;
    }

    public function getDetailVille($ville){
        $sel = new Select([ 'table' => 'ville' ]);
        $sel->where('id', ':id')->setColSel('nom, svg')->setExecute([ $ville ]);
        return $this->selectOne($sel);
    }

    public function getCountEmployeVille($ville){
        $sel = new Select([ 'table' => 'immobilier' ]);
        $sel->where('ville', ':ville')->setColSel('SUM(nb_employe) as nb_employe')->setExecute([ $ville ]);
        return $this->selectOne($sel)->nb_employe;
    }

    public function getIdVille($ville){
        $sel = new Select([ 'table' => 'ville' ]);
        $sel->where('nom', ':nom')->setExecute([ $ville ]);
        return $this->selectOne($sel)->id;
    }

    public function getInfoLocal($local){
        $sel = new Select([ 'table' => 'immobilier' ]);
        $sel->where('id', ':id')->setExecute([ $local ]);
        $data = $this->selectOne($sel);

        return $data->nom.' ('.$data->ville.')';
    }

    public function getRespOrga($resp){
        $sel = new Select([ 'table' => 'militaire' ]);
        $sel->where('id', ':id')->setExecute([ $resp ]);
        $data = $this->selectOne($sel);

        return [
            'id' => $data->id,
            'ident' => $data->prenom.' '.$data->nom
        ];
    }

    public function getListeAllMilitaire(){
        $sel = new Select([ 'table' => 'militaire', 'order' => 'nom ASC' ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $array[] = [
                'id' => $v->id,
                'nom' => $v->nom,
                'prenom' => $v->prenom,
                'age' => $v->age,
                'solde' => $v->solde,
                'grade' => $this->convertGrade($v->grade),
                'specialite' => ($v->specialite > 0) ? $this->getSpecHomme($v->specialite) : ''
            ];
        }

        return $array;
    }

    public function getListeTypeUnite(){
        $sel = new Select([ 'table' => 'type_orga' ]);
        $data = $this->selectMany($sel);

        $array_id = [];
        $array_nom = [];
        foreach($data as $v){
            $array_id[] = $v->id;
            $array_nom[] = $v->nom;
        }

        return array_combine($array_id, $array_nom);
    }

    public function getListMilit($orga){
        $sel = new Select([ 'table' => 'militaire' ]);
        $sel->where('organisation', ':orga')->setExecute([ $orga ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $array[] = [
                'id' => $v->id,
                'nom' => $v->nom,
                'prenom' => $v->prenom,
                'age' => $v->age,
                'solde' => $v->solde,
                'grade' => $this->convertGrade($v->grade),
                'specialite' => ($v->specialite > 0) ? $this->getSpecHomme($v->specialite) : ''
            ];
        }

        return $array;
    }

    public function convertGrade($grade){
        $sel = new Select([ 'table' => 'grade' ]);
        $sel->where('id', ':id')->setExecute([ $grade ]);
        return $this->selectOne($sel)->nom;
    }

    public function getSpecHomme($spec){
        $sel = new Select([ 'table' => 'role' ]);
        $sel->where('id', ':id')->setExecute([ $spec ]);
        return $this->selectOne($sel)->nom;
    }

    public function getListeMateriel($type){
        $sel = new Select([ 'table' => 'materiel', 'order' => 'id ASC' ]);
        $sel->where('categorie', ':cate')->setExecute([ $type ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $array[] = [
                'nom' => $v->nom,
                'nb' => number_format($v->nombre, 0, ',', ' '),
                'use' => number_format($v->use, 0, ',', ' '),
                'value' => number_format($v->use * $v->value, 0, ', ', ' ')
            ];
        }

        return $array;
    }

    public function getMaterielOrga($orga){
        $sel = new Select([ 'table' => 'organisation' ]);
        $sel->setColSel('materiel')->where('id', ':id')->setExecute([ $orga ]);
        $data = $this->selectOne($sel);

        $array = [];

        if(!strstr($data->materiel, '|') && !empty($data->materiel)){
            $exp = explode('=', $data->materiel);
            $array[ $exp[0] ] = $exp[1];
        } elseif(strstr($data->materiel, '|') && !empty($data->materiel)) {
            $expl = explode('|', $data->materiel);

            foreach($expl as $e){
                $exp = explode('=', $e);
                $array[ $e[0] ] = $e[1];
            }
        }

        return $array;
    }

    public function getListeDepense(){
        $sel = new Select([ 'table' => 'depense' ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $valeur = $this->getValueDepense($v->materiel) * $v->nombre;
            $this->somme_dep += $valeur;

            $array[] = [
                'materiel' => $v->materiel,
                'nombre' => $v->nombre,
                'valeur' => number_format($valeur, 0, ',', ' ')
            ];
        }

        return $array;
    }

    public function getValueDepense($materiel){
        $sel = new Select([ 'table' => 'materiel' ]);
        $sel->where('nom', ':name')->setColSel('value')->setExecute([ $materiel ]);
        return $this->selectOne($sel)->value;
    }

    public function getSumDepense(){
        return number_format($this->somme_dep, 0, ',', ' ');
    }
}