<?php
	namespace Bundles\AppBundle\Controllers;
    use Frash\Framework\DIC\Dic;
    use Frash\Framework\Request\Response;
    use Frash\Framework\Utility\Generator;

	class AjaxController{
		private $orm;
		private $request;

		public function __construct(Dic $dic){
			$this->orm = $dic->load('orm');
			$this->req = $this->orm->request('Ajax');
		}

		public function selectImmoAction(){
			return Response::Json($this->req->getImmobilier('%'.$_POST['nom'].'%'));
		}

		public function selectOfficAction(){
            return Response::Json($this->req->getMilitaire('%'.$_POST['nom'].'%'));
		}

		public function selectSupAction(){
            return Response::Json($this->req->getBranche('%'.$_POST['nom'].'%'));
		}

		public function generPasswordAction(){
			return Response::Json(Generator::get(30, true, true, true, false));
		}
	}