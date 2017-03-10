<?php
namespace Bundles\AppBundle\Repository;
use Frash\Framework\DIC\Dic;
use Frash\ORM\PGSQL\QueryBuilder;
use Frash\ORM\PGSQL\Request\Select;

class AdminRepository extends QueryBuilder{
    public function __construct(Dic $dic, $conn){
        parent::__construct($dic, $conn);
    }

    public function getListeRole(){
        $sel = new Select([ 'table' => 'role' ]);
        $data = $this->selectMany($sel);

        $array_id = [ 0 ];
        $array_nom = [ 'Rôle' ];

        foreach($data as $v){
            $array_id[] = $v->id;
            $array_nom[] = $v->nom;
        }

        return array_combine($array_id, $array_nom);
    }

    public function getListeEcole(){
        $sel = new Select([ 'table' => 'ecole' ]);
        $data = $this->selectMany($sel);

        $array_id = [ 0 ];
        $array_nom = [ 'Ecole' ];

        foreach($data as $v){
            $array_id[] = $v->id;
            $array_nom[] = $v->nom;
        }

        return array_combine($array_id, $array_nom);
    }

    public function getListeOrigine(){
        $sel = new Select([ 'table' => 'origine' ]);
        $data = $this->selectMany($sel);

        $array_id = [ 0 ];
        $array_nom = [ 'Origine' ];

        foreach($data as $v){
            $array_id[] = $v->id;
            $array_nom[] = $v->pays;
        }

        return array_combine($array_id, $array_nom);
    }

    public function getListeGrade(){
        $sel = new Select([ 'table' => 'grade' ]);
        $data = $this->selectMany($sel);

        $array_id = [ 0 ];
        $array_nom = [ 'Grade' ];

        foreach($data as $v){
            $array_id[] = $v->id;
            $array_nom[] = $v->nom;
        }

        return array_combine($array_id, $array_nom);
    }

    public function getListeMateriel(){
        $sel = new Select([ 'table' => 'materiel' ]);
        $data = $this->selectMany($sel);

        $array_id = [ 0 ];
        $array_nom = [ 'Matériel' ];

        foreach($data as $v){
            $array_id[] = $v->id;
            $array_nom[] = $v->nom;
        }

        return array_combine($array_id, $array_nom);
    }
}