<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller {
    private $baseUrl;
    private $path;

    public function __construct(){
        $this->baseUrl = env('API_BASE_URL');
        $this->path = 'profile/me';

        $this->middleware('prevent-back-history');
    }

    public function index(){
        $cookie = isset($_COOKIE['token']) ? $_COOKIE['token'] : null;
        $token =   $cookie;
        if(!$token) return "Vuelve a iniciar sesión";

        $url = $this->baseUrl.$this->path;
        $promise = Http::async()->withToken($token)
        ->acceptJson()
        ->get($url);

        return $promise;
    }
}
