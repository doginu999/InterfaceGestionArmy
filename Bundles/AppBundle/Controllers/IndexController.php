<?php
	namespace Bundles\AppBundle\Controllers;
	use Frash\Framework\DIC\Dic;

	class IndexController{
		private $sess_id;

		private $dic;
		private $form;
		private $redirect;
		private $session;

		public function __construct(Dic $dic){
			$this->dic = $dic;

			$this->session = $this->dic->load('session');
			$this->sess_id = $this->session->get('id');

            $this->form = $this->dic->load('form');
            $this->redirect = $this->dic->load('redirect');
		}

		public function indexAction(){
			if($this->sess_id !== false){ return $this->redirect->route('interface/')->go(); }

            $form = $this->form->create();
            $trad = $this->dic->load('trad')->multiple($this->dic->get('lang'), [ 'identity', 'password' ]);

			return $this->dic->load('tel')->view('index.tpl', [
                'form' => [
                    'start' => $form->init([ 'method' => 'post', 'action' => 'connexion/', 'id' => 'form_conn', 'csrf' => 'yes' ]),
                    'ident' => $form->text([ 'name' => 'ident', 'require' => true, 'class' => 'form-control', 'placeholder' => $trad->identity ]),
                    'password' => $form->password([ 'name' => 'password', 'require' => true, 'class' => 'form-control', 'placeholder' => $trad->password ]),
                    'submit' => $form->submit([ 'name' => 'submit_conn', 'value' => 'Connexion', 'id' => 'submit_conn', 'class' => 'btn btn-default' ]),
                    'end' => '</form>'
                ]
            ]);
		}

		public function connexionAction(){
			$post = $this->form->getPost();

            if($this->form->verif()->csrf($post->token, 'token') && $this->sess_id === false){
                $orm = $this->dic->load('orm');
                $c = $orm->request('Connexion');

                list($nom, $prenom) = explode('.', $post->ident);
                if($orm->counter()->countByNomAndPrenomAndPassword('Militaire', $nom, $prenom, sha1($post->password)) == 0){ return $this->redirect->route('home/')->go(); }

                $c->updConnexion($nom, $prenom, sha1($post->password));

                $this->session->set('id', $c->selectId($nom, $prenom, sha1($post->password)));
                $this->redirect->route('interface/')->go();
            }

            $this->redirect->route('home/')->go();
		}

		public function deconnexionAction(){
			$this->session->unsetAll();
            return $this->redirect->route('home/')->go();
		}
	}