<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductsController extends Controller {
    private $baseUrl;
    private $path;
    private $companyLogo;

    public function __construct(){
        $this->path = 'product';
        $this->baseUrl = env('API_BASE_URL');
        $this->companyLogo = env('LOGO_LIGHT');
    }

    private function getData($req, $url){
        $query = $req->getQueryString();
        if($query) $url .= "?$query";
        $res = Http::acceptJson()->get($url);
        return $res;
    }

    public function index(Request $req){
        $url = $this->baseUrl.$this->path;
        $category = $req->query('category');
        $subcategory = $req->query('subcategory');
        $res = $this->getData($req, $url);

        return view('products')->with([
            "res" => $res['data'],
            "companyLogo" => $this->companyLogo,
        ]);
    }
}
