<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller {
    public function __construct(){
        $this->middleware('prevent-back-history');
    }

    public function index(Request $req){
        $cookie = isset($_COOKIE['token']) ? $_COOKIE['token'] : null;
        $isLogged =   $cookie;
        
        if($isLogged == null){
            return view('login'); 
        } 

        return redirect('/');
    }
}
