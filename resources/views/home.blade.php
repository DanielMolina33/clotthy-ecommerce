@extends('index')

@section('header')
    <header class="contenedor_imagen">
      <div class="contenedor_fondo_azul">
        <div class="texto_inicio">
          <h1>Clotthy</h1>
          <button><a href="#products" class="contenido_button">Ver productos</a></button>
          <img src="{{ asset('images/icons/flecha-doble.svg') }}" alt="flechas" width="20">
        </div>
      </div>
  </header>
@endsection

@section('content_title', 'Productos')

@section('products')
  @foreach($res['data'] as $item)
    <x-product :item="$item"/>
  @endforeach
@endsection

@section('image')
  {{ $companyInfo['logo'] }}
@endsection

@section('redessociales')
  @foreach($companyInfo['redessociales'] as $item)
    <?php  
      $linkSm = $item['enlacered'];
      $nameSm = strtolower($item['nombrered']);
    ?>
    <a href="{{ $linkSm }}">
      <i class="fa-brands fa-{{ $nameSm }}"></i>
    </a>
  @endforeach
@endsection

@section('telefonos')
  @foreach($companyInfo['telefonos'] as $item)
    <?php  
      $number = $item['numerotelefono']; 
      $indicative = $item['indicativo'];
    ?>
    <p>{{ "+".$indicative." ".$number }}</p>
  @endforeach
@endsection

@section('script')
  <script>
    localStorage.removeItem('size');
    localStorage.removeItem('color');
  </script>
@endsection