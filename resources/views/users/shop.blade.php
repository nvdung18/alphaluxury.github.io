<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LWatch</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

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
                    <div class="breadcrumb__links col-lg-6 col-md-6">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                    <div class="find-panel col-lg-6 col-md-6">
                        <div class="style-select">
                            <select class="custom-select style-select-element" id="inputGroupSelect01">
                                <option value="0">Branch</option>
                                @foreach ($listTrademark as $key => $item)
                                    <option value="{{ $key + 1 }}">{{ $item->nameTrademark }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="style-select">
                            <select class="custom-select style-select-element" id="inputGroupSelect02">
                                <option value="0">Price</option>
                                <option value="1">
                                    < 7 triệu</option>
                                <option value="2">7 - 20 triệu</option>
                                <option value="3">20 -50 triệu</option>
                                <option value="4">50 - 200 triệu</option>
                                <option value="1">200 - 500 triệu</option>
                                <option value="1">> 500 triệu</option>
                            </select>
                        </div>
                        <div class="style-select">
                            <select class="custom-select style-select-element" id="inputGroupSelect03">
                                <option value="0">Gender</option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                            </select>
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
