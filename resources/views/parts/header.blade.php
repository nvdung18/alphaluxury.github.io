{{-- Header Section Begin --}}
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend/img/AlphaLogo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="{{$tag=="home" ? 'active' :''}}"><a href="{{ route('home') }}">Home</a></li>
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
                                                    <a href="#" class="column_a">{{ $item->nameTrademark }}</a>
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
                        <li class="{{$tag=="women" ? 'active' :''}}"><a href="{{ route('shop.women') }}">Women's</a></li>
                        <li class="{{$tag=="men" ? 'active' :''}}"><a href="{{ route('shop.men') }}">Men's</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        <a href="#">Login</a>
                        <a href="#">Register</a>
                    </div>
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="#"><span class="icon_bag_alt"></span>
                                <div class="tip">2</div>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
{{-- Header Section End --}}
