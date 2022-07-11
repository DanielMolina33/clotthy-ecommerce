<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\utils\Parameters;

class CartController extends Controller {
    private $profileController;
    private $baseUrl;
    private $path;
    private $parameters;

    public function __construct(){
        $this->parameters = new Parameters();
        $this->profileController = new ProfileController();
        $this->baseUrl = env('API_BASE_URL');
        $this->path = 'cart';
    }

    private function getCity($departmentId, $cityId){
        $url = $this->baseUrl.'city';

        $res = Http::acceptJson()->get($url, [
            'department_id' => $departmentId,
            'city_id' => $cityId
        ]);
        return $res['data'];
    }

    private function getDepartment($countryId, $departmentId){
        $url = $this->baseUrl.'department';
        $res = Http::acceptJson()->get($url, [
            'country_id' => $countryId,
            'department_id' => $departmentId
        ]);

        return $res['data'][0]['nombredepar'];
    }

    private function getCountry($countryId){
        $url = $this->baseUrl.'country';
        $res = Http::acceptJson()->get($url, ['country_id' => $countryId]);

        return $res['data'][0]['abreviaturapaises'];
    }

    public function index(){
        $token = isset($_COOKIE['token']) ? $_COOKIE['token'] : null;

        if($token){
            $url = $this->baseUrl.$this->path;
            $user = $this->profileController->index();
            $res = Http::withToken($token)->acceptJson()->get($url);
        
            if(isset($res['data'])){
                return view('cart')->with([
                    'products' => $res['data'],
                    'parameters' => $this->parameters,
                    'token' => hash('sha256', uniqid($token, true)),
                    'user' => $user,
                    'country' => $this->getCountry($user['idpais']),
                    'department' => $this->getDepartment($user['idpais'], $user['iddepar']),
                    'city' => $this->getCity($user['iddepar'], $user['idciudad'])
                ]);
            }   

            return view('cart')->with([
                'message' => $res['message'],
                'token' => hash('sha256', uniqid(rand(), true))
            ]);

        } else {
            return view('cart')->with([
                'message' => 'Inicia sesión para agregar productos al carrito',
                'token' => hash('sha256', uniqid(rand(), true))
            ]);
        }
    }

    public function empty(Request $req){
        $saleId = $req->query('id');
        $url =  $this->baseUrl.'get-cart';
        $token = isset($_COOKIE['token']) ? $_COOKIE['token'] : null;
        $res = Http::withToken($token)->acceptJson()->get($url, [
            'sale_id' => $saleId
        ]);
        $statusCode = $res->getStatusCode();
        
        if($statusCode == 201 || $statusCode == 200){
            return redirect('/cart');
            dd($res);
        } else {
            return "Hubo un problema con la transaccion...";
        }
    }
}
