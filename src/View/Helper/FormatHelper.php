<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Core\Configure;
use Cake\I18n\Number;

class FormatHelper extends Helper {

	public function numero($numero, $cel = false){


        $numero_formatado = '';

        if ($numero != '') {
            $numero_formatado = "(".substr($numero, 0,2).") ";

            if ($cel) {
                $numero_formatado .= substr($numero, 2,5)."-".substr($numero, 7,10);
            } else {
                $numero_formatado .= substr($numero, 2,5)."-".substr($numero, 6,9);
            }
        }
		
        

        return $numero_formatado;
	
	}

	
}
