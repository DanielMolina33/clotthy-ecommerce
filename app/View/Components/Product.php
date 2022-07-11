<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;

class Product extends Component {
    public $name;
    public $price;
    public $image;
    public $productId;
    public $ref;

    public function __construct($item){
        $this->name = $item['nombreprod'];
        $this->price = $item['preciofinal'];
        $this->image = $item['imgprod1'];
        $this->productId = $item['id'];
        $this->ref = $item['referenciaprod'];
    }

    public function render() {
        return view('components.product');
    }
}
