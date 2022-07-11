<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\utils\Parameters;
use App\Http\Controllers\utils\Company;

class HomeController extends Controller {
    private $parameters;
    private $company;
    private $companyLogo;

    public function __construct(){
        $this->company = new Company();
        $this->parameters = new Parameters();
        $this->companyLogo = env('LOGO_LIGHT');
    }
    
    public function index(){
        $isLogged = isset($_COOKIE['token']) ? $_COOKIE['token'] : null; 
        $categories = $this->parameters->getParameter("", "categorias");
        $companyInfo = $this->company->getCompanyInfo();

        return view('index')->with([
            "categories" => $categories,
            "companyInfo" => $companyInfo['data'],
            "companyLogo" => $this->companyLogo,
            "isLogged" => $isLogged
        ]);
    }
}
