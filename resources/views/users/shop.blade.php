<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LWatch</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
</head>

<body>
    {{-- Page Preloader --}}
    @include('parts.pre_loader')

    {{-- Off Canvas Menu Begin --}}
    @include('parts.off_canvas_menu')
    {{-- Off Canvas Menu End --}}

    {{-- Header Section Begin --}}
    @include('parts.header')
    {{-- Header Section End --}}

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="col-lg-12">
                <div class="row">
                    <div class="breadcrumb__links col-lg-5 col-md-5 d-flex align-items-center">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                    @php
                        // if ($tag == 'men' || $tag == 'male') {
                        //     # code...
                        //     $tag = 'male';
                        // } else {
                        //     # code...
                        //     $tag = 'female';
                        // }
                    @endphp
                    <div class="find-panel col-lg-7 col-md-7">
                        <div class="style-select col-md-7">
                            <div class="select-box">
                                <div class="options-container-branch">
                                    @foreach ($listTrademark as $key => $item)
                                        {{-- <option value="{{ $item->idTrademark }}">{{ $item->nameTrademark }}</option> --}}
                                        {{-- href="{{ route('shop/watch-men/style'.'/'.$tag.'-'.'as') }}"> --}}
                                        <a
                                            href="{{ $price == null
                                                ? route('shop.style-' . $tag . '-b', ['branch' => $item->idTrademark, 'type' => $tag])
                                                : route('shop.style-' . $tag . '-bp', ['branch' => $item->idTrademark, 'type' => $tag, 'price' => $price]) }}">
                                            <div class="option-branch">
                                                <p>{{ $item->nameTrademark }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                    @if (isset($nameTrademark))
                                        <a href="{{ $price == null 
                                        ? route('shop.'.$tag)
                                        : route('shop.style-' . $tag . '-p', ['type' => $tag, 'price' => $price]) }}">
                                            <div class="option-branch">
                                                <p class="text-center">--All--</p>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                                <div class="selected-branch">
                                    @if (empty($nameTrademark))
                                        Branch
                                    @else
                                        {{ $nameTrademark }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="style-select col-md-5">
                            <div class="select-box">
                                <div class="options-container-price">
                                    @php
                                        // create arr price
                                        $listPrice = ['< 7 triệu', '7 - 20 triệu', '20 -50 triệu', '50 - 200 triệu', '200 - 500 triệu', '> 500 triệu'];
                                    @endphp
                                    @foreach ($listPrice as $key => $value)
                                        <a {{ $item->idTrademark }}
                                            href="{{ $branch == null
                                                ? route('shop.style-' . $tag . '-p', ['type' => $tag, 'price' => $key + 1])
                                                : route('shop.style-' . $tag . '-bp', ['branch' => $branch, 'type' => $tag, 'price' => $key + 1]) }}">
                                            <div class="option-price">
                                                <p>
                                                    {{ $value }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                    @if (isset($price))
                                        <a href="{{ $branch == null 
                                            ? route('shop.'.$tag)
                                            : route('shop.style-' . $tag . '-b', ['branch' => $branch, 'type' => $tag]) }}">
                                            <div class="option-price">
                                                <p class="text-center">--All--</p>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                                <div class="selected-price">
                                    @if (empty($price))
                                        Price
                                    @else
                                        {{ $listPrice[$price - 1] }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Shop Section Begin -->
        <section class="shop spad">
            <div class="container">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        @foreach ($listProduct as $key => $item)
                            <div class="col-md-4 col-sm-6 mb-3 mt-5">
                                @include('parts.product')
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row col-lg-12 text-center d-flex justify-content-center mt-3">
                    {{ $listProduct->links('parts.pagination') }}
                </div>
            </div>
        </section>
        <!-- Shop Section End -->

        {{-- Footer Section Begin --}}
        @include('parts.footer')
        {{-- Footer Section End --}}
        <!-- Js Plugins -->
        <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
        <script src="{{ asset('frontend/js/owl.carousel.min.js ') }}"></script>
        <script src="{{ asset('frontend/js/jquery.nicescroll.min.js ') }}"></script>
        <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>
