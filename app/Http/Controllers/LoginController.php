<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller {
    public function __construct(){
        $this->middleware('prevent-back-history');
    }

    public function index(Request $req){
        $isLogged = isset($_COOKIE['token']) ? $_COOKIE['token'] : null;
        
        if($isLogged == null){
            return view('login'); 
        } 

        return redirect('/');
    }

    public function register(){
        $isLogged = isset($_COOKIE['token']) ? $_COOKIE['token'] : null;
        
        if($isLogged == null){
            return view('register'); 
        } 

        return redirect('/');
    }

    public function passwordForget(){
        return view('passwordForgot');
    }
}
