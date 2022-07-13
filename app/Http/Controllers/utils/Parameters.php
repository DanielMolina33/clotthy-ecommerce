<?php

namespace App\Http\Controllers\utils;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Promise;

class Parameters {
    private $baseUrl;
    private $path;

    public function __construct(){
        $this->baseUrl = env('API_BASE_URL');
        $this->path = 'parameter';
    }

    private function fetchData($promises){
        $results = Promise\unwrap($promises);
        $results = Promise\settle($promises)->wait();
        sleep(0.5);
        return $results;
    }

    public function getParameter($value, $type){
        $url = $this->baseUrl.$this->path;
        $promise = Http::async()->acceptJson()->get($url, ['search' => $type]);
        $result = $this->fetchData(['parameter' => $promise]);
        $res = $result['parameter']['value'];

        if($type == "categorias"){
            if(isset($res['data'])){
                return $res['data']['data'];
            } 
            
            return [];
        } else {
            if(isset($res['data'])){
                $parameterId = $res['data']['data'][0]['id'];
                $parameterValue = $this->getParameterValue($parameterId);

                foreach($parameterValue as $item){
                    if($item['id'] == $value){
                        return $item['nombretipos'];
                    }
                }
            } else {
                return "";
            }
        }
    }

    public function getParameterValue($parameterId){
        $url = $this->baseUrl.'parameter_value';
        $promise = Http::async()->acceptJson()->get($url, ['parameter_id' => $parameterId]);
        $result = $this->fetchData(['parameter_value' => $promise]);
        $res = $result['parameter_value']['value'];

        if(isset($res['data'])){
            return $res['data']['data'];
        }

        return [];
    }
}
