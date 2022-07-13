<?php

namespace App\Http\Controllers\utils;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Promise;

class Company {
    private $baseUrl;
    private $path;

    public function __construct(){
        $this->baseUrl = env('API_BASE_URL');
        $this->path = 'company';
    }

    private function fetchData($promises){
        $results = Promise\unwrap($promises);
        $results = Promise\settle($promises)->wait();
        return $results;
    }

    public function getCompanyInfo(){
        $url = $this->baseUrl.$this->path;
        $promise = Http::async()->acceptJson()->get($url, ['search' => 'clotthy']);
        $results = $this->fetchData(['company' => $promise]);
        $res = $results['company']['value'];

        if(isset($res['data'])){
            $companyId = $res['data']['data'][0]['id'];
            $promise = Http::async()->acceptJson()->get($url."/$companyId");
            $results = $this->fetchData(['companyInfo' => $promise]);
            $companyInfo = $results['companyInfo']['value'];
            return $companyInfo;
        }
    }
}

