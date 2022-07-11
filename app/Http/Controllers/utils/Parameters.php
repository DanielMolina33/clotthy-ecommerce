<?php

namespace App\Http\Controllers\utils;

use Illuminate\Support\Facades\Http;

class Parameters {
    private $baseUrl;
    private $path;

    public function __construct(){
        $this->baseUrl = env('API_BASE_URL');
        $this->path = 'parameter';
    }

    public function getParameter($value, $type){
        $url = $this->baseUrl.$this->path;
        $res = Http::acceptJson()->get($url, ['search' => $type]);
        
        if($type == "categorias"){
            return $res['data']['data'];
        } else {
            $parameterId = $res['data']['data'][0]['id'];
            $parameterValue = $this->getParameterValue($parameterId);

            foreach($parameterValue as $item){
                if($item['id'] == $value){
                    return $item['nombretipos'];
                }
            }
        }
    }

    public function getParameterValue($parameterId){
        $url = $this->baseUrl.'parameter_value';
        $res = Http::acceptJson()->get($url, ['parameter_id' => $parameterId]);
        return $res['data']['data'];
    }
}
