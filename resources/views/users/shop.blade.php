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
                    <div class="breadcrumb__links col-lg-8 col-md-8">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                    <div class="find-panel col-lg-4 col-md-4">
                        <div class="style-select">
                            <select class="custom-select" id="inputGroupSelect01">
                                <option value="1">Branch</option>
                                @for ($i=0;$i<30;$i++)
                                    <option value="1">One</option>
                                @endfor
                            </select>
                        </div>
                        <div class="style-select">
                            <select class="custom-select" id="inputGroupSelect01">
                                <option value="1">Price</option>
                                @for ($i=0;$i<30;$i++)
                                    <option value="1">One</option>
                                @endfor
                            </select>
                        </div>
                        <div class="style-select">
                            <select class="custom-select" id="inputGroupSelect01">
                                <option value="1">Gender</option>
                                @for ($i=0;$i<30;$i++)
                                    <option value="1">One</option>
                                @endfor
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
            {{-- <div class="col-lg-12 col-md-12">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="row">
                            <div class="section-title col-lg-8 col-md-8">
                                <h4>Men's watch</h4>
                            </div>
                            <div class="find-panel col-lg-4 col-md-8">
                                <div class="row">
                                    <div class="style-select">
                                        <span>Branch</span>
                                    </div>
                                    <div class="style-select">
                                        <span>Branch</span>
                                    </div>
                                    <div class="style-select">
                                        <span>Branch</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading active">
                                            <a data-toggle="collapse" data-target="#collapseOne">Branch</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li><a href="#">asdf</a></li>
                                                    <li><a href="#">sdf</a></li>
                                                    <li><a href="#">fd</a></li>
                                                    <li><a href="#">fd</a></li>
                                                    <li><a href="#">vsd</a></li>
                                                    <li><a href="#">Jeans</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseTwo">Price</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li><a href="#">asdjf</a></li>
                                                    <li><a href="#">Jackets</a></li>
                                                    <li><a href="#">Dresses</a></li>
                                                    <li><a href="#">Shirts</a></li>
                                                    <li><a href="#">T-shirts</a></li>
                                                    <li><a href="#">Jeans</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    @for ($i = 0; $i < 9; $i++)
                        <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                            <div class="single-box">
                                <div class="img-area"><img src="{{ asset('frontend/img/slider/images1.jpg') }}"
                                        alt=""></div>
                                <div class="img-text">
                                    <h5>Person One</h5>
                                    <span>asdkjakdsjaskd</span>
                                    <p>25,555</p>
                                    <div>
                                        <a href="" class="btn adjust btn-default btn-float btn-120 gray">Chi
                                            Tiết</a>
                                        <a href=""
                                            class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt
                                            Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="col-lg-12 text-center">
                    <div class="pagination__option">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
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
