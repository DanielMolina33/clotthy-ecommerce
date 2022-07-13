<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Producto</title>
    <link rel="stylesheet" href="{{ mix('css/menu.css') }}">
    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
    <link rel="stylesheet" href="{{ mix('css/grid_vista.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ mix('js/menu.js') }}"></script>
    <script src="{{ mix('js/menuConfig.js') }}"></script>
    <script src="{{ mix('js/select.js') }}"></script>
  </head>
  <body>
    <?php 
		$productId = $product['id'];
		$ref = $product['referenciaprod'];
	?>
    <x-navbar/>
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
			  <form id="form">
              	<input type="number" name="prod_amount"/>
              	<input type="hidden" name="id_prod_cart" value="{{ $productId }}"/>
			  </form>
            </div>
            <div class="select" id="talla">
              <span>Seleccione una talla</span>
              <ul>
                <li>
					<a href="{{ route('product', ['id' => $productId, 'ref' => $ref]) }}">{{ $size }}</a>
                </li>
                @if(isset($product['relacionados']))
                    @foreach($product['relacionados'] as $item)
                        @if($size != $item['strtalla'])
							<?php $id = $item['id']; ?>
                            <li>
								<a href="{{ route('product', ['id' => $id, 'ref' => $ref]) }}">{{ $item['strtalla'] }}</a>
							</li>
                        @endif
                    @endforeach
                @endif
              </ul>
            </div>
            <div class="select" id="color">
              <span>Seleccione un color</span>
              <ul>
                <li>
					<a href="{{ route('product', ['id' => $productId, 'ref' => $ref]) }}">{{ $color }}</a>
                </li>
                @if(isset($product['relacionados']))
                    @foreach($product['relacionados'] as $item)
                        @if($color != $item['strcolor'])
                            <?php $id = $item['id']; ?>
                            <li>
								<a href="{{ route('product', ['id' => $id, 'ref' => $ref]) }}">{{ $item['strcolor'] }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
              </ul>
            </div>
            <div class="botones">
              <input type="submit" form="form" value="Añadir al carrito" id="addToCart"/>
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
        prodAmount.addEventListener("change", verifyProdAmount);
        prodAmount.addEventListener("keyup", verifyProdAmount);
        prodAmount.addEventListener("blur", function(e){ e.preventDefault(); });

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
    </script>
    <script>
      localStorage.removeItem('order_by');
    </script>
    <script src="{{ mix('js/addToCart.js') }}"></script>
    @stack('script')
  </body>
</html>
