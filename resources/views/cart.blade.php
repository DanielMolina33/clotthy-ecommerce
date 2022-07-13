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
    <link rel="stylesheet" href="{{ mix('css/cart.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/menu.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ mix('js/menu.js') }}"></script>
    <script src="{{ mix('js/menuConfig.js') }}"></script>
    <title>Carrito</title>
</head>
<body>
    <x-navbar/>
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
                    $subtotal = 0;
                    if(count($city) > 0) $subtotal = $products['totalpago'] - $city['costoenvios'];
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
                        @if(isset($city))
                            @if(count($city) > 0)
                                @money($city['costoenvios'])
                            @else 
                                {{ "0" }}
                            @endif
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
                   @if(isset($products) && isset($city))
                        @if(count($city) > 0)
                            <form>
                                <?php
                                    $email = $user['usuario']['email'];
                                    $fullName = isset($user['nombres']) && isset($user['apellidos']) ? $user['nombres'].' '.$user['apellidos'] : null;
                                    $idNumber = isset($user['numerodocumento']) ? $user['numerodocumento'] : null;
                                    $idType = $parameters->getParameter($user['tipodocumento'], "tipo de documento");
                                    $address = count($user['direccion']) > 0 ? $user['direccion'][0]['direccion'] : null;
                                    $complements = count($user['direccion']) > 0 ? $user['direccion'][0]['complementos'] : null;
                                    $cityName = $city['nombreciudades'];
                                    $phone = "N/A";
                                    $indicative = "N\A";

                                    foreach($user['numeros'] as $number){
                                        $numberType = $parameters->getParameter($number['tiponumero'], "tipo de numero");
                                        if(strtolower($numberType) == "celular"){
                                            $phone = $number['numerotelefono'];
                                            $indicative = $number['indicativo'];
                                            break;
                                        }
                                    }
                                ?>
                                <script
                                    src="https://checkout.wompi.co/widget.js"
                                    data-redirect-url="{{ env('PAGE_URL') }}/transaction"
                                    data-render="button"
                                    data-public-key="pub_test_EyKaSLkQ6kGG3WtIYJWcjiZ9RJ7IYnY8"
                                    data-currency="COP"
                                    data-amount-in-cents="{{ $total*100 }}"
                                    data-reference="{{ $token }}"
                                    data-customer-data:email="{{ $email }}"
                                    @if($fullName)data-customer-data:full-name="{{ $fullName }}"@endif
                                    @if($phone!="N/A")data-customer-data:phone-number={{ $phone }}@endif
                                    @if($phone!="N/A")data-customer-data:phone-number-prefix="+57"@endif
                                    @if($idNumber)data-customer-data:legal-id="{{ $idNumber }}"@endif
                                    @if($address)
                                        data-customer-data:legal-id-type="{{ $idType }}"
                                        data-shipping-address:country="{{ $country }}"
                                        data-shipping-address:city="{{ $cityName }}"
                                        data-shipping-address:region="{{ $department }}"
                                        data-shipping-address:phone-number="{{ $phone }}"
                                        data-shipping-address:address-line-1="{{ $address }}"
                                        @if($complements)data-shipping-address:address-line-2="{{ $complements }}"@endif
                                    @endif
                                ></script>
                            </form>
                        @endif
                    @else
                        <button class="checkout-cta">Pagar con Wompi</button>
                    @endif
                </div>
            </div>
        </aside>
    </main>
    <script>
        localStorage.removeItem('size');
        localStorage.removeItem('color');
        localStorage.removeItem('order_by');

        localStorage.setItem("cartId", "<?php echo isset($cartId)?$cartId:null ?>");
    </script>
    <script src="{{ mix('js/cart.js') }}"></script>
    @stack('script')
</body>
</html>