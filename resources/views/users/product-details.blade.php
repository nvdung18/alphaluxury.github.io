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

    {{-- Header Section Begin --}}
    @include('parts.header')
    {{-- Header Section End --}}

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="#">{{ $tag }}’s </a>
                        <span>{{ $productdetails->nameProduct }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    {{-- Product Details Section Begin --}}
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            <a class="pt active" href="#product-1">
                                <img src="{{ asset('frontend/img/product/' . $productdetails->image) }}"
                                    alt="No Image">
                            </a>
                            <a class="pt" href="#product-2">
                                @if (isset(explode('.',explode('/',$product['nameImgDetail1'])[2])[1]))
                                    <img src="{{ asset('frontend/img/product/' . $product['nameImgDetail1']) }}"
                                        alt="No Image">
                                @endif
                            </a>
                            <a class="pt" href="#product-3">
                                @if (isset(explode('.',explode('/',$product['nameImgDetail2'])[2])[1]))
                                    <img src="{{ asset('frontend/img/product/' . $product['nameImgDetail2']) }}"
                                        alt="No Image">
                                @endif
                            </a>
                            {{-- <a class="pt" href="#product-4">
                                <img src="{{ asset('frontend/img/product/details/thumb-4.jpg') }}" alt="">
                            </a> --}}
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                <img data-hash="product-1" class="product__big__img"
                                    src="{{ asset('frontend/img/product/' . $productdetails->image) }}" alt="No Image">
                                @if (isset(explode('.',explode('/',$product['nameImgDetail1'])[2])[1]))
                                    <img data-hash="product-2" class="product__big__img"
                                        src="{{ asset('frontend/img/product/' . $product['nameImgDetail1']) }}"
                                        alt="No Image">
                                @endif
                                @if (isset(explode('.',explode('/',$product['nameImgDetail2'])[2])[1]))
                                    <img data-hash="product-3" class="product__big__img"
                                        src="{{ asset('frontend/img/product/' . $product['nameImgDetail2']) }}"
                                        alt="No Image">
                                @endif
                                {{-- <img data-hash="product-4" class="product__big__img"
                                    src="{{ asset('frontend/img/product/details/thumb-4.jpg') }}" alt=""> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="product__details__text">
                        <h3>{{ $productdetails->nameProduct }}<span>Brand: {{ $productdetails->nameTrademark }}</span>
                        </h3>
                        <div class="product__details__price"> {{ number_format($productdetails->price, 0, '.', '.') }}
                            VND<span> {{ number_format(12630000, 0, '.', '.') }}VND</span></div>
                        <p>{{ $productdetails->description }}</p>
                        <div class="product__details__button">
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="pro-qty">
                                    <span class="dec qtybtn">-</span>
                                    <input name="quantity" type="text" value="1">
                                    <span class="inc qtybtn">+</span>
                                </div>
                            </div>
                            <a href="#" class="cart-btn btn-cart" idproduct={{ $productdetails->idProduct }}
                                data-url="{{ route('add_product_to_cart') }}"><span class="icon_bag_alt"></span> Add to
                                cart</a>
                            <ul>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                            </ul>
                        </div>
                        <div class="product__details__widget">
                            <ul>
                                <li>
                                    <span>Promotions:</span>
                                    <p>Free shipping</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab">Write a
                                    review</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Reviews ( 2
                                    )</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Write a review</h6>
                                <textarea class="review-product" id="" style="width: 100%;" placeholder="Enter a product review..."></textarea>
                                <button type="button" class="btn btn-outline-secondary send-review">Send
                                    review</button>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Reviews ( 2 )</h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                    quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                    Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                    voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                    consequat massa quis enim.</p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                    quis, sem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>RELATED PRODUCTS</h5>
                    </div>
                </div>
                @php
                    $relateProductNumber = 0;
                @endphp
                @foreach ($relatedProduct as $key => $item)
                    @if ($productdetails->idProduct != $item->idProduct && $relateProductNumber<4)
                        @php
                            $relateProductNumber++;
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset('frontend/img/product/'.$item->image) }}">
                                    <div class="label new">New</div>
                                    <ul class="product__hover">
                                        <li><a href="{{ asset('frontend/img/product/related/rp-1.jpg') }}"
                                                class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="#"><span class="icon_search"></span></a></li>
                                        <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{$item->nameProduct}}</a></h6>
                                    <div class="product__price">{{number_format($item->price)}}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>


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
