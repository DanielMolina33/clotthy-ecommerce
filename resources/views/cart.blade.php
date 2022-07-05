<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/cart.css') }}"/>
  <title>Carrito</title>
</head>
<body>
    <main>
        <div class="basket">
            <div class="basket-labels">
            <ul>
                <li class="item item-heading">Producto</li>
                <li class="price">Precio</li>
                <li class="quantity">Cantidad</li>
                <li class="subtotal">Subtotal</li>
            </ul>
            </div>
            <?php
                if(isset($products)){
                    $cartId = $products['id'];
                    $subtotal = $products['totalpago'] - $shippingPrice;
                    $total = $products['totalpago'];
                }
            ?>
            @if(isset($products))
                @foreach($products['productos'] as $product)
                    <?php 
                        $productId = $product['id'];
                        $img = $product['imgprod1'];
                        $name = $product['nombreprod'];
                        $amount = $product['cantidad'];
                        $size = $parameters->getParameter($product['talla'], "tallas");
                        $color = $parameters->getParameter($product['color'], "colores");
                        $price = $product['preciofinal'];
                    ?>
                    <div class="basket-product">
                        <div class="item">
                            <div class="product-image">
                                <img src="{{ $img }}" alt="Producto" class="product-frame">
                            </div>
                            <div class="product-details">
                                <h1>
                                    <strong>
                                        <span class="item-quantity">{{ $amount }} x</span>
                                        {{ $name }}
                                    </strong>
                                </h1>
                                <p>
                                    <strong>{{ $color }}, Talla {{ $size }}</strong>
                                </p>
                            </div>
                        </div>
                        <div class="price">@money($price)</div>
                        <div class="quantity">
                            <input 
                                type="number"
                                value="{{ $amount }}"
                                class="quantity-field"
                            >
                        </div>
                        <div class="subtotal">@money($price * $amount)</div>
                        <div class="remove">
                            <button class="btn">Quitar</button>
                        </div>
                        <input type="hidden" value="{{ $productId }}" id="productId"/>
                    </div>
                @endforeach
            @else
                <div>
                    <h1>{{ $message }}</h1>
                </div>
            @endif
        </div>
        <aside>
            <div class="summary">
                <div class="summary-total-items"><span class="total-items"></span>Resumen de compra</div>
                <div class="summary-subtotal">
                    <div class="subtotal-title">Precio de envio</div>
                    <div class="subtotal-value final-value" id="basket-subtotal">
                        @if(isset($shippingPrice))
                            @money($shippingPrice)
                        @else 
                            {{ "0" }}
                        @endif
                    </div>
                </div>
                <div class="summary-subtotal">
                    <div class="subtotal-title">Subtotal</div>
                    <div class="subtotal-value final-value" id="basket-subtotal">
                        @if(isset($subtotal))
                            @money($subtotal)
                        @else 
                            {{ "0" }}
                        @endif
                    </div>
                </div>
                <div class="summary-total">
                    <div class="total-title">Total</div>
                    <div class="total-value final-value total-value--custom" id="basket-total">
                        @if(isset($total))
                            @money($total)
                        @else 
                            {{ "0" }}
                        @endif
                    </div>
                </div>
                <div class="summary-checkout">
                    <button class="checkout-cta">Pagar con Wompi</button>
                </div>
            </div>
        </aside>
    </main>
    <script>
        localStorage.removeItem('size');
        localStorage.removeItem('color');
        localStorage.setItem("cartId", "<?php echo isset($cartId)?$cartId:null ?>");
    </script>
    <script src="{{ mix('js/cart.js') }}"></script>
</body>
</html>