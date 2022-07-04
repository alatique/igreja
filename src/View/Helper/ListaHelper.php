<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Core\Configure;
use Cake\I18n\Number;

class ListaHelper extends Helper {

	public function estados(){
		
		return ['NA' => __('estado...'),
                'AC'=>'Acre',             'AL'=>'Alagoas',             'AP'=>'Amapá',
                'AM'=>'Amazonas',         'BA'=>'Bahia',               'CE'=>'Ceará',
                'DF'=>'Distrito Federal', 'ES'=>'Espírito Santo',      'GO'=>'Goiás',
                'MA'=>'Maranhão',         'MT'=>'Mato Grosso',         'MS'=>'Mato Grosso do Sul',
                'MG'=>'Minas Gerais',     'PA'=>'Pará',                'PB'=>'Paraíba',
                'PR'=>'Paraná',           'PE'=>'Pernambuco',          'PI'=>'Piauí',
                'RJ'=>'Rio de Janeiro',   'RN'=>'Rio Grande do Norte', 'RS'=>'Rio Grande do Sul',
                'RO'=>'Rondônia',         'RR'=>'Roraima',             'SC'=>'Santa Catarina',
                'SP'=>'São Paulo',        'SE'=>'Sergipe',             'TO'=>'Tocantins'
            ];
	}

	public function tiposMembros(){

		return ['MB' => __('membro') 
               ,'SC' => __('secretaria')
               ,'TS' => __('tesoureiro')
               ,'DC' => __('diacono')
               ,'PB' => __('presbitero')
               ,'PR'=> __('pastor') ];
	}
}
