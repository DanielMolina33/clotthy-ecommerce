<header>
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ $logo }}"/>
        </a>
    </div>
    <div class="menu_bar">
        <span><i class="fas fa-bars"></i></span>
    </div>
    <div class="menu_options">
        <ul class="menu_options_container">
            @if($isLogged)
                <li class="option">
                    <a href="" class="option_login">Mi perfil</a>
                </li>
            @endif
            <li class="option">
                @if($isLogged == null)
                    <a href="{{ url('/login') }}" class="option_login">Iniciar sesión</a>
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
</header>
<nav>
    <ul class="menu">
        @foreach($categories as $category)
            <?php
                $categoryId = $category['id'];
                $catName = strtolower($category['nombretipo']);
                $subcategories = $parameters->getParameterValue($categoryId);
            ?>
            <li class="submenu" id="Camisas">
                <span>{{ ucfirst($catName) }}</span>
                <ul>
                    @foreach($subcategories as $subcategory)
                        <?php $subName = strtolower($subcategory['nombretipos']); ?>
                        <li>
                            <a href="{{ url("/products/?category=$catName&subcategory=$subName") }}">
                                {{ ucfirst($subName) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</nav>
@push('script')
    <script>
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
@endpush