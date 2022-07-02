<a class="contenido" href="{{ route('product', ['id' => $productId, 'ref' => $ref]) }}">
    <div class="contenedor_img_contenido">
        <img src="{{ $image }}" alt="{{$name}}" title="{{$name}}">
    </div>
    <h2>{{ $name }}</h2>
    <p>@money($price)</p>
    <hr/>
</a>