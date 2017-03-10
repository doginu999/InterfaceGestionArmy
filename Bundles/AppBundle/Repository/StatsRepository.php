<?php
namespace Bundles\AppBundle\Repository;
use Frash\Framework\DIC\Dic;
use Frash\ORM\PGSQL\QueryBuilder;
use Frash\ORM\PGSQL\Request\{ Select, Where };

class StatsRepository extends QueryBuilder{
    private $total_annuel_solde = 0;

    public function __construct(Dic $dic, $conn){
        parent::__construct($dic, $conn);
    }

    public function getNbMilitaire(){
        $sel = new Select([ 'table' => 'militaire' ]);
        $sel->setCount();
        return $this->selectOne($sel)->number_result;
    }

    public function getOrigines(){
        $sel = new Select([ 'table' => 'origine' ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $array[ $v->pays ] = $v->nombre;
        }

        return $array;
    }

    public function getRoles(){
        $sel = new Select([ 'table' => 'militaire' ]);
        $sel->setGroupBy('specialite')->setColSel('specialite, COUNT(specialite) as nb_spec');
        $data = $this->customMany($sel);

        $array = [];
        foreach($data as $v){
            $array[ $this->getNameRole($v['specialite']) ] = $v['nb_spec'];
        }

        return $array;
    }

    public function getGrades(){
        $sel = new Select([ 'table' => 'grade', 'order' => 'id ASC' ]);
        $sel->where('nombre', '>', ':nb')->setExecute([ 0 ]);
        $data = $this->selectMany($sel);

        $array = [];
        foreach($data as $v){
            $array[ $v->nom ] = $v->nombre;
        }

        return $array;
    }

    public function getNameRole($role){
        $sel = new Select([ 'table' => 'role' ]);
        $sel->where('id', ':id')->setColSel('nom')->setExecute([ $role ]);
        return $this->selectOne($sel)->nom;
    }

    public function getMoySolde(){
        $sel = new Select([ 'table' => 'militaire' ]);
        $sel->setColSel('AVG(solde) as solde');
        return number_format($this->selectOne($sel)->solde, 0, ',', ' ');
    }

    public function getTotalSolde(){
        $sel = new Select([ 'table' => 'militaire' ]);
        $sel->setColSel('SUM(solde) as solde');
        $data = $this->selectOne($sel)->solde;
        $this->setTotalAnnuelSolde($data);
        return number_format($data, 0, ',', ' ');
    }

    public function getTotalAnnuelSolde(){
        return $this->total_annuel_solde;
    }

    public function setTotalAnnuelSolde($total_solde){
        $this->total_annuel_solde = number_format($total_solde * 12, 0, ',', ' ');
    }
}