<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <title>Producto</title>
    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
    <link rel="stylesheet" href="{{ mix('css/grid_vista.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ mix('js/select.js') }}"></script>
  </head>
  <body>
    <main>
      <section class="img_vista">
        <div><img src="{{ $product['imgprod1'] }}" alt="Imagen de producto 1"></div>
        @if($product['imgprod1'])
            <div><img src="{{ $product['imgprod1'] }}" alt="Imagen de producto 2"></div>
        @endif
        @if($product['imgprod1'])
            <div><img src="{{ $product['imgprod1'] }}" alt="Imagen de producto 3"></div>
        @endif
        @if($product['imgprod1'])
            <div><img src="{{ $product['imgprod1'] }}" alt="Imagen de producto 4"></div>
        @endif
      </section>
      <section class="compra">
        <div>
          <div class="titulo_descripcion">
            <h3>{{ $product['nombreprod'] }}</h3>
          </div>
          <div class="precio_envio">
            <p>@money($product['preciofinal'])</p>
            <p>{{ $product['existenciaprod'] }} Unidades disponibles</p>
          </div>
          <div class="controles">
            <div class="cantidad" id="prodAmount">
              <label>Cantidad</label>
              <input type="number"/>
            </div>
            <div class="select" id="talla">
              <span>Seleccione una talla</span>
              <ul>
                <li>{{ $size }}</li>
                @if(isset($product['relacionados']))
                    @foreach($product['relacionados'] as $item)
                        @if($size != $item['strtalla'])
                            <li>{{ $item['strtalla'] }}</li>
                        @endif
                    @endforeach
                @endif
              </ul>
            </div>
            <div class="select" id="color">
              <span>Seleccione un color</span>
              <ul>
                <li>{{ $color }}</li>
                @if(isset($product['relacionados']))
                    @foreach($product['relacionados'] as $item)
                        @if($color != $item['strcolor'])
                            {{-- Add link to another related product --}}
                            <li>{{ $item['strcolor'] }}</li>
                        @endif
                    @endforeach
                @endif
              </ul>
            </div>
            <div class="botones">
              <input type="button" value="Añadir al carrito" id="addToCart"/>
            </div>
          </div>
        </div>
      </section>
      <section class="detalles_producto">
        <h3>Detalles producto</h3>
        <p>{{ $product['descripcionprod'] }}</p>
      </section>
    </main>

    <script>
        const prodAmount = document.querySelector("#prodAmount");
        const btnAddToCart = document.querySelector('#addToCart');

        prodAmount.addEventListener("change", verifyProdAmount);
        prodAmount.addEventListener("keyup", verifyProdAmount);
        prodAmount.addEventListener("blur", function(e){ e.preventDefault(); });
        btnAddToCart.addEventListener("click", addToCart);

        function verifyProdAmount(e){
            const value = e.target.value;
            const prodAmount = getProdAmount();

            if(parseInt(value) > parseInt(prodAmount)){
                alert("No puedes elegir una cantidad mayor a la cantidad de unidades disponibles");
            }
        }

        function getProdAmount(){
            const prodAmount = "<?php echo $product['existenciaprod'] ?>";
            return prodAmount;
        }

        function addToCart(e){
            const token = localStorage.getItem('token');

            if(!token){
                document.location.href = "http://127.0.0.1:8000/";
            } else {
                console.log("Go to shopping cart");
            }
        }
    </script>
  </body>
</html>
