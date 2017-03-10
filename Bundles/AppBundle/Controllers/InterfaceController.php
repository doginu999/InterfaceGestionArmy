<?php
    namespace Bundles\AppBundle\Controllers;
    use Frash\Framework\DIC\Dic;

    class InterfaceController{
        public function interfaceAction(Dic $dic){
            $sess_id = $dic->load('session')->get('id');
            if($sess_id === false){ return $dic->load('redirect')->route('home/')->go(); }

            return $dic->load('tel')->view('interface.tpl', [
                'rang' => $dic->load('orm')->finder()->findOne('Militaire', $sess_id)->rang
            ]);
        }
    }