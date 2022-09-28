<!DOCTYPE html>
<html lang="zxx">

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

    {{-- Header Section Begin --}}
    @include('parts.header')
    {{-- Header Section End --}}

    {{-- Categories Section Begin --}}
    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="categories__item categories__large__item set-bg"
                        data-setbg="{{ asset('frontend/img/categories/category-1.jpg') }}">
                        <div class="categories__text">
                            <h1>Women’s fashion</h1>
                            <p>Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore
                                edolore magna aliquapendisse ultrices gravida.</p>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="{{ asset('frontend/img/categories/category-2.jpg') }}">
                                <div class="categories__text">
                                    <h4>Men’s fashion</h4>
                                    <p>358 items</p>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="{{ asset('frontend/img/categories/category-3.jpg') }}">
                                <div class="categories__text">
                                    <h4>Kid’s fashion</h4>
                                    <p>273 items</p>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="{{ asset('frontend/img/categories/category-4.jpg') }}">
                                <div class="categories__text">
                                    <h4>Cosmetics</h4>
                                    <p>159 items</p>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="{{ asset('frontend/img/categories/category-5.jpg') }}">
                                <div class="categories__text">
                                    <h4>Accessories</h4>
                                    <p>792 items</p>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Product Section Begin --}}
    <section class="product spad">
        <div class="container width-1500">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>New product</h4>
                    </div>
                </div>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators" style="display: none">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <div class="single-box">
                                <div class="img-area"><img src="{{ asset('frontend/img/slider/images1.jpg') }}" alt=""></div>
                                <div class="img-text">
                                    <h5>Person One</h5>
                                    <span>asdkjakdsjaskd</span>
                                    <p>25,555</p>
                                    <div>
                                        <a href="" class="btn adjust btn-default btn-float btn-120 gray">Chi Tiết</a>
                                        <a href="" class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="single-box">
                                <div class="img-area"><img src="{{ asset('frontend/img/slider/images1.jpg') }}" alt=""></div>
                                <div class="img-text">
                                    <h5>Person Two</h5>
                                    <span>sdasdadasda</span>
                                    <p>177,555,20</p>
                                    <div>
                                        <a href="" class="btn adjust btn-default btn-float btn-120 gray">Chi Tiết</a>
                                        <a href="" class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="single-box">
                                <div class="img-area"><img src="{{ asset('frontend/img/slider/images1.jpg') }}" alt=""></div>
                                <div class="img-text">
                                    <h5>Person Three</h5>
                                    <span>Person One</span>
                                    <p>asdjasjdha</p>
                                    <div>
                                        <a href="" class="btn adjust btn-default btn-float btn-120 gray">Chi Tiết</a>
                                        <a href="" class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                   <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-box">
                                <div class="img-area"><img src="{{ asset('frontend/img/slider/images1.jpg') }}" alt=""></div>
                                <div class="img-text">
                                    <h5>Person Four</h5>
                                    <span>asdkjakdsjaskd</span>
                                    <p>asdjasjdhassssssjdhajdshjsa</p>
                                    <div>
                                        <a href="" class="btn adjust btn-default btn-float btn-120 gray">Chi Tiết</a>
                                        <a href="" class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-box">
                                <div class="img-area"><img src="{{ asset('frontend/img/slider/images1.jpg') }}" alt=""></div>
                                <div class="img-text">
                                    <h5>Person Five</h5>
                                    <span>asdkjakdsjaskd</span>
                                    <p>asdjasjdhassssssjdhajdshjs</p>
                                    <div>
                                        <a href="" class="btn adjust btn-default btn-float btn-120 gray">Chi Tiết</a>
                                        <a href="" class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-box">
                                <div class="img-area"><img src="{{ asset('frontend/img/slider/images1.jpg') }}" alt=""></div>
                                <div class="img-text">
                                    <h5>Person Six</h5>
                                    <span>asdkjakdsjaskd</span>
                                    <p>asdjasjdhassssssjdhajdshjsa</p>
                                    <div>
                                        <a href="" class="btn adjust btn-default btn-float btn-120 gray">Chi Tiết</a>
                                        <a href="" class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                   <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-box">
                                <div class="img-area"><img src="{{ asset('frontend/img/slider/images1.jpg') }}" alt=""></div>
                                <div class="img-text">
                                    <h5>Person Seven</h5>
                                    <span>asdkjakdsjaskd</span>
                                    <p>asdjasjdhassssssjdhajdshjsadh</p>
                                    <div>
                                        <a href="" class="btn adjust btn-default btn-float btn-120 gray">Chi Tiết</a>
                                        <a href="" class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-box">
                                <div class="img-area"><img src="{{ asset('frontend/img/slider/images1.jpg') }}" alt=""></div>
                                <div class="img-text">
                                    <h5>Person Eight</h5>
                                    <span>asdkjakdsjaskd</span>
                                    <p>asdjasjdhassssssjdhajdshjs</p>
                                    <div>
                                        <a href="" class="btn adjust btn-default btn-float btn-120 gray">Chi Tiết</a>
                                        <a href="" class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-box">
                                <div class="img-area"><img src="{{ asset('frontend/img/slider/images1.jpg') }}" alt=""></div>
                                <div class="img-text">
                                    <h5>Person Nine</h5>
                                    <span>asdkjakdsjaskd</span>
                                    <p>asdjasjdhassssssjdhajdsh</p>
                                    <div>
                                        <a href="" class="btn adjust btn-default btn-float btn-120 gray">Chi Tiết</a>
                                        <a href="" class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div> 
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon icon-prev" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon icon-next" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            {{-- <div class="row property__gallery">
                @foreach ($listProduct as $key => $item)
                    @if ($key < 8)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix women">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset('frontend/img/product/product-1.jpg') }}">
                                    <div class="label new">New</div>
                                    <ul class="product__hover">
                                        <li><a href="{{ asset('frontend/img/product/product-1.jpg') }}"
                                                class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{ $item->name }}</a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">$ {{ $item->price }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                {{-- Phan trang --}}
                {{-- {{$listProduct->links()}} --}} 
            {{-- </div> --}}
        </div>
    </section>

    {{-- Banner Section Begin --}}
    <section class="banner set-bg" data-setbg="{{ asset('frontend/img/banner/banner-1.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 m-auto">
                    <div class="banner__slider owl-carousel">
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Chloe Collection</span>
                                <h1>The Project Jacket</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Chloe Collection</span>
                                <h1>The Project Jacket</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Chloe Collection</span>
                                <h1>The Project Jacket</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Banner section end --}}

    {{-- Trend Section Begin --}}
    <section class="trend spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Hot Trend</h4>
                        </div>
                        @for ($i = 0; $i < 3; $i++)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="{{ asset('frontend/img/trend/ht-1.jpg') }}" alt="">
                                </div>
                                <div class="trend__item__text">
                                    <h6>Chain bucket bag</h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">$ 59.0</div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Best seller</h4>
                        </div>
                        @for ($i = 0; $i < 3; $i++)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="{{ asset('frontend/img/trend/bs-1.jpg') }}" alt="">
                                </div>
                                <div class="trend__item__text">
                                    <h6>Cotton T-Shirt</h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">$ 59.0</div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Feature</h4>
                        </div>
                        @for ($i = 0; $i < 3; $i++)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="{{ asset('frontend/img/trend/f-1.jpg') }}" alt="">
                                </div>
                                <div class="trend__item__text">
                                    <h6>Bow wrap skirt</h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">$ 59.0</div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Trend Section End --}}

    {{-- Discount Section Begin --}}
    <section class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="discount__pic">
                        <img src="{{ asset('frontend/img/discount.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="discount__text">
                        <div class="discount__text__title">
                            <span>Discount</span>
                            <h2>Summer 2019</h2>
                            <h5><span>Sale</span> 50%</h5>
                        </div>
                        <div class="discount__countdown" id="countdown-time">
                            <div class="countdown__item">
                                <span>22</span>
                                <p>Days</p>
                            </div>
                            <div class="countdown__item">
                                <span>18</span>
                                <p>Hour</p>
                            </div>
                            <div class="countdown__item">
                                <span>46</span>
                                <p>Min</p>
                            </div>
                            <div class="countdown__item">
                                <span>05</span>
                                <p>Sec</p>
                            </div>
                        </div>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Section Begin --}}
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-car"></i>
                        <h6>Free Shipping</h6>
                        <p>For all oder over $99</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-money"></i>
                        <h6>Money Back Guarantee</h6>
                        <p>If good have Problems</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-support"></i>
                        <h6>Online Support 24/7</h6>
                        <p>Dedicated support</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-headphones"></i>
                        <h6>Payment Secure</h6>
                        <p>100% secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Services Section End --}}

    {{-- Instagram Begin --}}
    @include('parts.instagram')
    {{-- Instagram End --}}

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
