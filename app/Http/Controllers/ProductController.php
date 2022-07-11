<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\utils\Parameters;

class ProductController extends Controller {
    private $baseUrl;
    private $path;
    private $prodAmount;
    private $parameters;

    public function __construct(){
        $this->parameters = new Parameters();
        $this->baseUrl = env('API_BASE_URL');
        $this->path = 'product';
    }

    public function index($id, $ref){
        $url = $this->baseUrl.$this->path.'/'.$id;
        $res = Http::acceptJson()->get($url, ['ref' => $ref]);
        $size = $this->parameters->getParameter($res['data']['talla'], "tallas");
        $color = $this->parameters->getParameter($res['data']['color'], "colores");

        return view('product')->with([
            "product" => $res['data'],
            "size" => $size, 
            "color" => $color
        ]);
    }
}
