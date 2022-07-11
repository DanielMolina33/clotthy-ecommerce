<?php

namespace App\Http\Controllers\utils;

use Illuminate\Support\Facades\Http;

class Company {
    private $baseUrl;
    private $path;

    public function __construct(){
        $this->baseUrl = env('API_BASE_URL');
        $this->path = 'company';
    }

    public function getCompanyInfo(){
        $url = $this->baseUrl.$this->path;
        $res = Http::acceptJson()->get($url, ['search' => 'clotthy']);
        $companyId = $res['data']['data'][0]['id'];
        $companyInfo = Http::acceptJson()->get($url."/$companyId");
        return $companyInfo;
    }
}

