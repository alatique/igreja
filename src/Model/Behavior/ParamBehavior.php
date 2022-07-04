<?
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Core\Configure;

class ParamBehavior extends Behavior
{

	public function initialize(array $config)
	{
	    // Some initialization code here
	}


    public function formataValorParam($valor) {

        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);

        return $valor;
    }

    public function formataDataParam($data, $sem_caracteres = false) {

        $originalDate = $data;

        //converte caracter / para - 
        $originalDateConvertida = str_replace('/', '-', $originalDate);

        //formato americano
        if ($sem_caracteres) {
            $DateAmericano = date("Ymd", strtotime($originalDateConvertida));
        } else {
            $DateAmericano = date("Y-m-d", strtotime($originalDateConvertida));
        }


        return $DateAmericano;
    }


    public function formataDataParamUI($data, $data_br = false) {

        $originalDate = $data;

        //converte caracter / para - 
        $originalDateConvertida = str_replace('/', '-', $originalDate);

        //formato Brasil/US
        if ($data_br) {
            $DateFormat = date("d/m/Y", strtotime($originalDateConvertida));
        } else {
            $DateFormat = date("m/d/Y", strtotime($originalDateConvertida));
        }


        return $DateFormat;
    }


    public function formataDataParamFromApp($data) {

        
        $datas_explode = explode("-", $data);

        $nova_data = substr($datas_explode[2],0,2) . "/" . $datas_explode[1] . "/" . $datas_explode[0];

        return $nova_data;
    }

    public function formataValorMilhares($valor) {

        $unidade = null;
        $valor_novo = $valor;

        if($valor >= 1000){
            $valor_novo = round($valor / 1000, 2) . " K" ;
        }

        if($valor >= 1000000){
            $valor_novo = round($valor / 1000000, 2) .  " M" ;
        } 

        if($valor >= 1000000000){
            $valor_novo = round($valor / 1000000000,2) . " Bi" ;
        }


        return $valor_novo;
    }

    public function limpaCnpj($cnpj){

        $cnpj = trim($cnpj);
        $retorno = str_replace(array(',', '.', '-', '/', ':'), '', $cnpj);
        return $retorno;
    }


}