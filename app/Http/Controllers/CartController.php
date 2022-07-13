<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Promise;
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
        
        $this->middleware('prevent-back-history');
    }

    private function getCity($departmentId, $cityId){
        $url = $this->baseUrl.'city';
        $promise = Http::async()->acceptJson()->get($url, [
            'department_id' => $departmentId,
            'city_id' => $cityId
        ]);
        
        return $promise;
    }

    private function getDepartment($countryId, $departmentId){
        $url = $this->baseUrl.'department';
        $promise = Http::async()->acceptJson()->get($url, [
            'country_id' => $countryId,
            'department_id' => $departmentId
        ]);
        
        return $promise;
    }

    private function getCountry($countryId){
        $url = $this->baseUrl.'country';
        $promise = Http::async()->acceptJson()->get($url, ['country_id' => $countryId]);
        return $promise;
    }

    private function getUser(){
        $promise = $this->profileController->index();
        $result = $this->fetchData([
            'user' => $promise,
        ]);
        return $result['user']['value']['data'];
    }

    private function getCartProducts($token){
        $url = $this->baseUrl.$this->path;
        $promise = Http::async()->withToken($token)->acceptJson()->get($url);
        return $promise;
    }
    
    private function fetchData($promises){
        $results = Promise\unwrap($promises);
        $results = Promise\settle($promises)->wait();
        sleep(0.5);
        return $results;
    }

    private function getData($token){
        $products = $this->getCartProducts($token);
        $user = $this->getUser();

        if(isset($user)){
            $cityId = $user['idciudad'];
            $departmentId = $user['iddepar'];
            $countryId = $user['idpais'];

            $promises = [
                'products' => $products,
                'city' => $this->getCity($departmentId, $cityId),
                'department' =>  $this->getDepartment($countryId, $departmentId),
                'country' => $this->getCountry($countryId)
            ];

            return [
                'user' => $user,
                'results' => $this->fetchData($promises)
            ];
        }

        return [];
    }

    public function index(){
        $token = isset($_COOKIE['token']) ? $_COOKIE['token'] : null;

        if($token){
            $results = $this->getData($token);

            if(count($results) > 0){
                $user = $results['user'];
                $data = $results['results'];
                $products = $data['products']['value'];
                
                if(isset($products['data'])){
                    $city = $data['city']['value']['data'];
                    $department = $data['department']['value']['data'][0]['nombredepar'];
                    $country = $data['country']['value']['data']['0']['abreviaturapaises'];
    
                    return view('cart')->with([
                        'products' => $products['data'],
                        'parameters' => $this->parameters,
                        'token' => hash('sha256', uniqid($token, true)),
                        'user' => $user,
                        'city' => $city,
                        'department' => $department,
                        'country' => $country
                    ]);
                } else {
                    return view('cart')->with([
                        'message' => $products['message'],
                        'token' => hash('sha256', uniqid(rand(), true))
                    ]);
                }
            } 

            return view('cart')->with([
                'message' => 'Hubo un error, intentalo de nuevo',
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
        } else {
            return "Hubo un problema con la transaccion...";
        }
    }
}
