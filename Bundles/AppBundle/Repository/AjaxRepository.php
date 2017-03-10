<?php
namespace Bundles\AppBundle\Repository;
use Frash\Framework\DIC\Dic;
use Frash\ORM\PGSQL\QueryBuilder;
use Frash\ORM\PGSQL\Request\Select;

class AjaxRepository extends QueryBuilder{
    public function __construct(Dic $dic, $conn){
        parent::__construct($dic, $conn);
    }

    public function getImmobilier($nom){
        $sel = new Select([ 'table' => 'immobilier' ]);
        $sel->where('nom', 'LIKE', ':nom')->setExecute([ $nom ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $array[] = [
                'id' => $v->id,
                'nom' => $v->nom
            ];
        }

        return $array;
    }

    public function getMilitaire($nom){
        $sel = new Select([ 'table' => 'militaire' ]);
        $sel->where('nom', 'LIKE', ':nom')->setExecute([ $nom ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $array[] = [
                'id' => $v->id,
                'nom' => $v->nom,
                'prenom' => $v->prenom,
                'grade' => $this->convertGrade($v->grade)
            ];
        }

        return $array;
    }

    public function convertGrade($grade){
        $sel = new Select([ 'table' => 'grade' ]);
        $sel->where('id', ':id')->setExecute([ $grade ]);
        return $this->selectOne($sel)->nom;
    }

    public function getBranche($nom){
        $sel = new Select([ 'table' => 'organisation', 'limit' => '15' ]);
        $sel->where('nom', 'LIKE', ':nom')->setExecute([ $nom ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $array[] = [
                'id' => $v->id,
                'nom' => $v->nom
            ];
        }

        return $array;
    }
}