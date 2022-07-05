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
        $parameterId = $res['data']['data'][0]['id'];
        $sizes = $this->getParameterValue($parameterId);

        foreach($sizes as $item){
            if($item['id'] == $value){
                return $item['nombretipos'];
            }
        }
    }

    private function getParameterValue($parameterId){
        $url = $this->baseUrl.'parameter_value';
        $res = Http::acceptJson()->get($url, ['parameter_id' => $parameterId]);
        return $res['data']['data'];
    }
}
