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

    private function getShippingPrice(){
        $profile = $this->profileController->index();
        $cityId = $profile['idciudad'];
        $url = $this->baseUrl.'city';

        $res = Http::acceptJson()
        ->get($url, ['city_id' => $cityId]);

        return $res['data']['costoenvios'];
    }

    public function index($token){
        $url = $this->baseUrl.$this->path;
        $res = Http::withToken($token)
        ->acceptJson()
        ->get($url);
        
        $shippingPrice = $this->getShippingPrice();

        if(isset($res['data'])){
            return view('cart')->with([
                'products' => $res['data'],
                'shippingPrice' => $shippingPrice,
                'parameters' => $this->parameters
            ]);
        }

        return view('cart')->with('message', $res['message']);
    }
}
