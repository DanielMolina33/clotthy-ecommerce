<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\utils\Company;
use App\Http\Controllers\utils\Parameters;

class Navbar extends Component {
    public $logo;
    public $categories;
    public $parameters;
    public $isLogged;

    public function __construct(){
        $company = new Company();
        $this->isLogged = isset($_COOKIE['token']) ? $_COOKIE['token'] : null; 
        $this->parameters = new Parameters();
        $this->categories = $this->parameters->getParameter("", "categorias");
        $this->logo = env('LOGO_DARK');
    }

    public function render(){
        return view('components.navbar');
    }
}
