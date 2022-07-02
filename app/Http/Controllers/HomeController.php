<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller {
    private $baseUrl;
    private $path;

    public function __construct(){
        $this->baseUrl = env('API_BASE_URL');
        $this->path = 'product';
    }

    private function getCompanyInfo(){
        $url = $this->baseUrl.'company';
        $res = Http::acceptJson()->get($url, ['search' => 'clotthy']);
        $companyId = $res['data']['data'][0]['id'];
        $companyInfo = Http::acceptJson()->get($url."/$companyId");
        return $companyInfo;
    }

    public function index(){
        $url = $this->baseUrl.$this->path;
        $res = Http::acceptJson()->get($url);
        $companyInfo = $this->getCompanyInfo();
        return view('home')->with([
            "res" => $res['data'],
            "companyInfo" => $companyInfo['data']
        ]);
    }
}
