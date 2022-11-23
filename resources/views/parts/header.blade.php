{{-- Header Section Begin --}}
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend/img/AlphaLogo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ $tag == 'home' ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                        <li class="dropdown">
                            <a href="#" id="branch">Branch</a>
                            <div class="dropdown-content">
                                <div class="row_content row">
                                    @php
                                        $columnTrademark = $countTrademark / 5;
                                        $columnElements = 0; //0=>5, 5=>10, 10=>15
                                        if ($countTrademark % 5 != 0) {
                                            # code...
                                            $columnTrademark += 1;
                                        }
                                    @endphp
                                    @for ($i = 1; $i <= $columnTrademark; $i++)
                                        <div class="column_content">
                                            @foreach ($listTrademark as $key => $item)
                                                @if ($key >= $columnElements && $key < $i * 5)
                                                    <a href="{{ route('product-branch', ['idTrademark' => $item->idTrademark, 'tag' => 'branch']) }}"
                                                        class="column_a">{{ $item->nameTrademark }}</a>
                                                @endif
                                            @endforeach
                                        </div>
                                        @php
                                            $columnElements += 5;
                                        @endphp
                                    @endfor
                                </div>
                            </div>
                        </li>
                        <li class="{{ $tag == 'women' ? 'active' : '' }}"><a
                                href="{{ route('shop.women') }}">Women's</a>
                        </li>
                        <li class="{{ $tag == 'men' ? 'active' : '' }}"><a href="{{ route('shop.men') }}">Men's</a></li>
                        <li class="{{ $tag == 'contact' ? 'active' : '' }}"><a
                                href="{{ route('contact', ['tag' => 'contact']) }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-4 right-menu">
                <div class="header__right">
                    <div class="header__right__auth">
                        @if (Auth::check())
                            <div class="select-box">
                                <div class="options-container">
                                    <a href="{{ route('user.page') }}">
                                        <div class="option">
                                            <p class="text-center">User page</p>
                                        </div>
                                    </a>
                                    <a href="{{ route('logout') }}">
                                        <div class="option">
                                            <p class="text-center">Log out</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="selected">
                                    @if (Auth::user())
                                        {{ Auth::user()->nameUser }}
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="style-select">
                                <div class="select-box select-index">
                                    <div class="options-container">
                                        <div class="option">
                                            <input type="radio" class="radio" id="automobiles" name="category" />
                                            <label for="automobiles">
                                                <a class="btn" style="color: white" href="{{ route('user.page') }}">
                                                    User Page
                                                </a>
                                            </label>
                                        </div>
                                        <div class="option">
                                            <input type="radio" class="radio" id="science" name="category" />
                                            <label for="science">
                                                <button class="btn" style="color: white" onclick="Redirect()">
                                                    Log out
                                                </button>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="selected">
                                        @if (Auth::user())
                                            {{ Auth::user()->nameUser }}
                                        @endif
                                    </div>
                                </div>
                            </div> --}}
                        @else
                            <a href="{{ route('user.login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    </div>
                    <ul class="header__right__widget">
                        <li>
                            {{-- <input type="text"> --}}
                            <span class="icon_search search-switch"></span>
                        </li>
                        <li>
                            <div>
                                {{-- <a href="{{ asset('') }}"></a> --}}
                                <a href="#"><span class="icon_bag_alt"></span>
                                    <div class="tip"></div>
                                    <div class="header__cart-list">
                                        <img src="./assets/img/no-cart.png" alt=""
                                            class="header__cart-no-cart-img">
                                        <span class="header__cart-list-no-cart-msg">
                                            Chưa có sản phẩm
                                        </span>

                                        <h4 class="header__cart-heading">
                                            Sản phẩm đã thêm
                                        </h4>
                                        <ul class="header__cart-list-item">
                                            {{-- <div class="header_list">
                                        
                                        </div> --}}
                                        </ul>
                                        <a class="header__cart-view-cart btn--default btn--primary link-cart"
                                            href="{{ route('shop-cart', ['tag' => $tag]) }}">
                                            Xem giỏ hàng
                                        </a>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
    <script type="text/javascript">
        // function Redirect() {
        //     window.location.assign('http://127.0.0.1:8000/logout');
        // }

        // function showPersonelPage() {
        //     window.location.assign('http://127.0.0.1:8000/user/userpage?tag_form=profile');
        // }
    </script>
</header>
{{-- Header Section End --}}
