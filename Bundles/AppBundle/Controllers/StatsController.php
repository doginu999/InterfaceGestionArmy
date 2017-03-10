<?php
	namespace Bundles\AppBundle\Controllers;
	use Frash\Framework\Dic\Dic;

	class StatsController{
		private $sess_id;
		private $stats;

		private $dic;
		private $counter;
		private $orm;

		public function __construct(Dic $dic){
			$this->dic = $dic;

			$this->sess_id = $this->dic->load('session')->get('id');
            if($this->sess_id === false){ return $this->dic->load('redirect')->route('home/')->go(); }

            $this->orm = $this->dic->load('orm');
            $this->counter = $this->orm->counter();
            $this->stats = $this->orm->request('Stats');
		}

		public function statsAction(){
			return $this->dic->load('tel')->view('stats/stats.tpl', [
                'nombre' => $this->stats->getNbMilitaire(),
                'origine' => $this->stats->getOrigines(),
                'moy_solde' => $this->stats->getMoySolde(),
                'total_solde' => $this->stats->getTotalSolde(),
                'total_annuel_solde' => $this->stats->getTotalAnnuelSolde(),
                'nb_homme' => $this->counter->countBySexe('Militaire', 'M'),
                'nb_femme' => $this->counter->countBySexe('Militaire', 'F'),
                'role' => $this->stats->getRoles(),
                'grade' => $this->stats->getGrades()
            ]);
		}
	}