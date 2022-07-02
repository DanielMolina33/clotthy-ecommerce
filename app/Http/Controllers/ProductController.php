<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller {
    private $baseUrl;
    private $path;
    private $prodAmount;

    public function __construct(){
        $this->baseUrl = env('API_BASE_URL');
        $this->path = 'product';
    }

    private function getParameter($sizeId, $type){
        $url = $this->baseUrl.'parameter';
        $res = Http::acceptJson()->get($url, ['search' => $type]);
        $parameterId = $res['data']['data'][0]['id'];
        $sizes = $this->getParameterValue($parameterId);

        foreach($sizes as $item){
            if($item['id'] == $sizeId){
                return $item['nombretipos'];
            }
        }
    }

    private function getParameterValue($parameterId){
        $url = $this->baseUrl.'parameter_value';
        $res = Http::acceptJson()->get($url, ['parameter_id' => $parameterId]);
        return $res['data']['data'];
    }

    public function getProdAmount(){
        return response(['data' => $this->prodAmount], 200);
    }

    public function index($id, $ref){
        $url = $this->baseUrl.$this->path.'/'.$id;
        $res = Http::acceptJson()->get($url, ['ref' => $ref]);
        $size = $this->getParameter ($res['data']['talla'], "tallas");
        $color = $this->getParameter ($res['data']['color'], "colores");

        return view('product')->with([
            "product" => $res['data'],
            "size" => $size, 
            "color" => $color
        ]);
    }
}
