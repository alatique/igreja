<?php

namespace App\Controller;
use App\Controller\AppController;

class RelatorioController extends AppController
{
    
    public function index(){

        /*$this->viewBuilder()->layout('admin');*/

    }

    public function gerar($usuario_id){


        /*$this->loadModel('TransfermarktNoMatch');
        $lista = $this->TransfermarktNoMatch->find()
                                           ->where(['TransfermarktNoMatch.usuario_id' => $usuario_id,
                                                    'TransfermarktNoMatch.sta_process' => 1])
                                           ->order(["TransfermarktNoMatch.dt_date" => 'DESC']);

        $nome_arquivo = "Informe - Extraccion NoMatch - " . date("d-m-y-H-i-s") . '.xls';


        $this->viewBuilder()->layout('ajax');  

        $this->set(compact('lista'));
        $this->set(compact('nome_arquivo'));*/

    }



}