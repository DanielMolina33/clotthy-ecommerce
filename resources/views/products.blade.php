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
    <link rel="stylesheet" href="{{ mix('css/products.css') }}">
    <link rel="stylesheet" href="{{ mix('css/menu.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ mix('js/menu.js') }}"></script>
    <script src="{{ mix('js/menuConfig.js') }}"></script>
    <title>Productos</title>
    <style>
        nav { margin-bottom: 50px; }
        main { margin-bottom: 100px; }
    </style>
</head>
<body>
    <x-navbar/>
    <main>
        <details class="filters" id="filters">
            <summary class="filters_title" id="filtersTitle">
                Filtros <i class="fa-solid fa-caret-down"></i>
            </summary>
            <ul class="filters_options">
                <li class="filters_option">
                    <input type="checkbox" value="asc" class="orderBy" id="asc"/>
                    <label for="asc">Precio: ascendente</label>
                </li>
                <li class="filters_option">
                    <input type="checkbox" value="desc" class="orderBy" id="desc"/>
                    <label for="desc">Precio: descendente</label>
                </li>
            </ul>
        </details>
        <section class="contenedor_articles" id="products">
            <div class="grid" id="grid">
                @if(count($res['data']) >= 1)
                    @foreach($res['data'] as $item)
                        <x-product :item="$item"/>
                    @endforeach
                @else
                    <h1 class="empty">No hay nada para mostrar</h1>
                @endif
            </div>
        </section>
        <section class="pagination">
            <a href="" data-prev="{{ $res['prev_page_url'] }}"  id="prevPage">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <div class="pages">
                <input
                    type="number"
                    id="inputPage"
                    value=
                    @if(count($res['data']) >= 1)
                        {{ $res['current_page'] }}
                    @else
                        0
                    @endif
                />
                <p>De 
                    @if($res['last_page'])
                        {{ $res['last_page'] }}
                    @else 
                        0
                    @endif
                </p>
            </div>
            <a href="" data-next="{{ $res['next_page_url'] }}"  id="nextPage">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </section>
    </main>
    <script>
        localStorage.removeItem('size');
        localStorage.removeItem('color');
    </script>
    <script src="{{ mix('js/orderBy.js') }}"></script>
    <script src="{{ mix('js/pagination.js') }}"></script>
    @stack('script')
</body>
</html>