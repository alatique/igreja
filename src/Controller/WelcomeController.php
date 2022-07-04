<?php

namespace App\Controller;
use App\Controller\AppController;

class WelcomeController extends AppController
{
    
    public function index(){

        $this->loadComponent('Csrf');
        $header = $this->request->getParam('_csrfToken');

        $this->viewBuilder()->layout('admin');
        $this->set(compact('header'));

    }

    public function getDadosGraficoBarra(){

        $this->loadModel('Grafico');
        $resultado = $this->Grafico->listaDizimosOfertasAnoAtual();
        $this->set(compact('resultado'));
        $this->set('_serialize', ['resultado']);

    }

    public function getDadosGraficoFidelidade(){

        $this->loadModel('Grafico');
        $resultado = $this->Grafico->fidelidadeAnoPorcentagem();
        $this->set(compact('resultado'));
        $this->set('_serialize', ['resultado']);

    }



}