<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function weather()
    {
        // Sua chave de API HG Braisl
        $chave  = '7805a908';
        $ip     = $_SERVER["REMOTE_ADDR"];
        $lat    = isset($_GET['lat']) ? $_GET['lat'] : '';
        $lon    = isset($_GET['lon']) ? $_GET['lon'] : '';

        // Obtem os dados da API passando os parametros
        $dados = $this->hg_request(array('lat' => $lat, 'lon' => $lon, 'user_ip' => $ip), $chave);

        // Formata dos dados recebidos
        echo json_encode(array(
                'temperatura'   => $dados->results->temp.' ºC',
                'umidade'       => $dados->results->humidity.' %',
                'descricao'     => $dados->results->description,
                'cidade'        => $dados->results->city,
                'nascer_do_sol' => $dados->results->sunrise,
                'por_do_sol'    => $dados->results->sunset,
                'vento'         => $dados->results->wind_speedy,
                'imagem'        => 'https://assets.hgbrasil.com/weather/imagens/'.$dados->results->img_id.'.png',
            ));
    }

    /* ================================================
    * Resgata os dados da API HG Brasil
    *
    * Parametros:
    *
    * parametros: array, informe os dados que quer enviar para a API
    * chave: string, informe sua chave de acesso
    * endpoint: string, informe qual API deseja acessar, padrao weather (previsao do tempo)
    */
    private function hg_request($parametros, $chave = null, $endpoint = 'weather'){

        $url = 'https://api.hgbrasil.com/'.$endpoint.'/?format=json&';
        if(is_array($parametros)){

            // Insere a chave nos parametros
            if(!empty($chave)) $parametros = array_merge($parametros, array('key' => $chave));

            // Transforma os parametros em URL
            foreach($parametros as $key => $value){
                if(empty($value)) continue;
                $url .= $key.'='.urlencode($value).'&';
            }

            // Obtem os dados da API
            $resposta = file_get_contents(substr($url, 0, -1));
            return json_decode($resposta);

        }
        else {
            return false;
        }

    }

}
