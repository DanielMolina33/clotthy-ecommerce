<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.5">
  <!-- <link rel="icon" type="image/png" href="images/icons/logo.png"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ mix('css/style.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ mix('js/efecto.js') }}" charset="utf-8"></script>
  <title>Clotthy</title>
</head>
<body>
  @yield('header')

  <section class="contenedor_articles" id="products">
    <div class="contenedor_titulo">
      <hr/><h1>@yield('content_title')</h1><hr/>
    </div>
    <div class="grid" id="grid">
      @yield('products')
    </div>
  </section>

  <footer class="contenedor_empresa">
    <div class="contenedor_empresa_img">
      <img src="@yield('image')"/>
    </div>
    <div class="contenedor_empresa_contacto">
      <div class="redessociales">
        @yield('redessociales')
      </div>
      <div class="telefonos">
        @yield('telefonos')
      </div>
    </div>
  </footer>
    @yield('script')
</body>
</html>
