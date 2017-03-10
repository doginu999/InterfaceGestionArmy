<?php
namespace Bundles\AppBundle\Repository;
use Frash\Framework\DIC\Dic;
use Frash\ORM\PGSQL\QueryBuilder;
use Frash\ORM\PGSQL\Request\{ Select, Update, Where };

class ConnexionRepository extends QueryBuilder{
    public function __construct(Dic $dic, $conn){
        parent::__construct($dic, $conn);
    }

    public function updConnexion($nom, $prenom, $password){
        $upd = new Update('militaire');
        $wh = new Where;
        $upd->setUpdate([ 'connexion' => ':conn' ]);
        $wh->where('nom', ':nom')->andWhere('prenom', ':prenom')->andWhere('password', ':password');
        $upd->setWhere($wh);
        $upd->setExecute([ date('d/m/Y à H:i'), $nom, $prenom, $password ]);
        $this->update($upd);
    }

    public function selectId($nom, $prenom, $password){
        $sel = new Select([ 'table' => 'militaire' ]);
        $sel->where('nom', ':nom')->andWhere('prenom', ':prenom')->andWhere('password', ':password')->setColSel('id')->setExecute([ $nom, $prenom, $password ]);
        return $this->selectOne($sel)->id;
    }
}