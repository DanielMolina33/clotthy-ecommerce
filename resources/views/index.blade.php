<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
  <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="{{ mix('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ mix('js/efecto.js') }}" charset="utf-8"></script>
  <title>Clotthy</title>
</head>
<body>
  <header class="contenedor_imagen">
    <div class="menu_options">
      <ul class="menu_options_container">
        {{-- @if($isLogged)
          <li class="option">
            <a href="" class="option_login">Mi perfil</a>
          </li>
        @endif --}}
        <li class="option">
          @if($isLogged == null)
            <a href="{{ url('/login') }}" class="option_login">Login</a>
          @else
            <a href="" class="option_login" id="logout">Cerrar sesión</a>
          @endif
        </li>
        <li class="option">
          <a href="{{ url('cart') }}" class="option_cart">
            <i class="fa-solid fa-cart-shopping" id="cart"></i>
          </a>
        </li>
      </ul>
    </div>
    <div class="contenedor_fondo_azul">
      <div class="texto_inicio">
        <h1>Clotthy</h1>
        <button>
          <a href="#products" class="contenido_button">Ver categorias</a>
        </button>
        <img src="{{ asset('images/icons/flecha-doble.svg') }}" alt="flechas" width="15">
      </div>
    </div>
  </header>
  <section class="contenedor_articles" id="products">
    <div class="contenedor_titulo">
      <hr/>
        <h1>Categorias</h1>
      <hr/>
    </div>
    <div class="grid" id="grid">
      @foreach($categories as $category)
        <?php $name = strtolower($category['nombretipo']); ?>
        <a href="{{ url('/products/?category='.$name) }}" class="contenido">
          <h2 title="Ir al articulo">{{ ucfirst($name) }}</h2> 
        </a>
      @endforeach
    </div>
  </section>

  <footer class="contenedor_empresa">
    <div class="contenedor_empresa_img">
      <img src="{{ $companyLogo }}"/>
    </div>
    <div class="contenedor_empresa_contacto">
      <div class="redessociales">
        @foreach($companyInfo['redessociales'] as $item)
          <?php  
            $linkSm = $item['enlacered'];
            $nameSm = strtolower($item['nombrered']);
          ?>
          <a href="{{ $linkSm }}">
            <i class="fa-brands fa-{{ $nameSm }}"></i>
          </a>
        @endforeach
      </div>
      <div class="telefonos">
        @foreach($companyInfo['telefonos'] as $item)
          <?php  
            $number = $item['numerotelefono']; 
            $indicative = $item['indicativo'];
          ?>
          <p>{{ "+".$indicative." ".$number }}</p>
        @endforeach
      </div>
    </div>
  </footer>
  <script>
    localStorage.removeItem('size');
    localStorage.removeItem('color');
    localStorage.removeItem('order_by');
    
    const cartId = localStorage.getItem("cartId");
    const cartIcon = document.querySelector("#cart");

    if(cartId){
        cartIcon.classList.add('cart');
    } else {
        cartIcon.classList.remove('cart');
    }
  </script>
    @if($isLogged)
        <script src="{{ mix('js/logout.js') }}"></script>
    @endif
</body>
</html>
