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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-12">
                    <h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">Have a coupon?</a>
                        Click
                        here to enter your code.</h6>
                </div>
            </div> --}}
             {{-- @isset($success) --}}
             {{-- @php
                 if(isset($success)) {
                    $check = true;
                 } else {
                    $check = false;
                 }
             @endphp --}}
             @if($errors->has('success'))
             <input type="hidden" name="messageorder" value="{{ $errors->first('success') }}">
             @endif
             {{-- @endisset --}}
            <form action="{{ route('addcheckout') }}" class="checkout__form" method="POST"> 
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Billing detail</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    @if ($errors->has('fullname'))
                                    <span class="alert alert-danger notification" style="color: red;">
                                          {{ $errors->first('fullname') }}
                                        </span>
                                        @endif
                                    <p>FullName <span>*</span></p>
                                    <input type="text" name="fullname" value="{{ $all_us_ac->fullname }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                {{-- <div class="checkout__form__input">
                                    <p>Country <span>*</span></p>
                                    <input type="text" name="country" value="">
                                </div> --}}
                                <div class="checkout__form__input">
                                    @if ($errors->has('streetaddress'))
                                    <span class="alert alert-danger notification" style="color: red;">
                                          {{ $errors->first('streetaddress') }}
                                        </span>
                                        @endif
                                    <p>Address <span>*</span></p>
                                    <input type="text" placeholder="Street Address" name="streetaddress">
                                    <input type="text" placeholder="Apartment. suite, unite ect ( optinal )" name="addressoptional">
                                </div>
                                <div class="checkout__form__input">
                                    @if ($errors->has('city_or_towm'))
                                    <span class="alert alert-danger notification" style="color: red;">
                                          {{ $errors->first('city_or_towm') }}
                                    </span>
                                    @endif
                                    <p>Town/City <span>*</span></p>
                                    <input type="text" name="city_or_towm">
                                </div>
                                <div class="checkout__form__input">
                                    @if ($errors->has('country_or_state'))
                                    <span class="alert alert-danger notification" style="color: red;">
                                          {{ $errors->first('country_or_state') }}
                                    </span>
                                     @endif
                                    <p>Country/State <span>*</span></p>
                                    <input type="text" name="country_or_state">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    @if ($errors->has('phone'))
                                    <span class="alert alert-danger notification" style="color: red;">
                                          {{ $errors->first('phone') }}
                                    </span>
                                        @endif
                                    <p>Phone <span>*</span></p>
                                    <input type="text" name="phone">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    @if ($errors->has('email'))
                                    <span class="alert alert-danger notification" style="color: red;">
                                          {{ $errors->first('email') }}
                                    </span>
                                        @endif
                                    <p>Email <span>*</span></p>
                                    <input type="text" name="email" value="{{ $all_us_ac->email }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                {{-- <div class="checkout__form__input">
                                    <p>Account Password <span>*</span></p>
                                    <input type="text">
                                </div> --}}
                                {{-- <div class="checkout__form__checkbox">
                                    <label for="note">
                                        Note about your order, e.g, special noe for delivery
                                        <input type="checkbox" id="note">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
                                <div class="checkout__form__input">
                                    @if ($errors->has('ordernotes'))
                                    <span class="alert alert-danger notification" style="color: red;">
                                          {{ $errors->first('ordernotes') }}
                                    </span>
                                    @endif
                                    <p>Oder notes <span>*</span></p>
                                    <input type="text"
                                        placeholder="Note about your order, e.g, special noe for delivery" name="ordernotes">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout__order">
                            <h5>Your order</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Product</span>
                                        <span class="top__text__right">Total</span>
                                    </li>
                                    @php
                                       $i = 0;
                                       $subtotal = 0; 
                                    @endphp
                                    <input type="hidden" name="product_in_cart" value="{{ $product_of_us }}">
                                    @foreach ($product_in_cart as $item)
                                    @php
                                        $subtotal += $item->price*$item->quantity;
                                    @endphp
                                    <li style="display: flex"><span class="productcheckout">{{ ++$i }}. {{ $item->nameProduct }}</span> <span>{{ number_format($item->price, 0 ,".", ".") }} x {{ $item->quantity }} </span></li>
                                    @endforeach
                                    {{-- <li>01. Chain buck bag <span>$ 300.0</span></li>
                                    <li>02. Zip-pockets pebbled<br /> tote briefcase <span>$ 170.0</span></li>
                                    <li>03. Black jean <span>$ 170.0</span></li>
                                    <li>04. Cotton shirt <span>$ 110.0</span></li> --}}
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    <li>Discount <span> {{ ($discount != 'prcode_01') ? $prcode->discountPercent : "0"  }}%</span></li>
                                    <li>Deliveryfee <span> 0 VNĐ</span></li>
                                    <li>Subtotal <span> {{ number_format($subtotal,0,'.','.') }} VNĐ</span></li>
                                    <li>Total <span> {{ ($discount == 'prcode_01') ? number_format($subtotal,0,'.','.') : number_format($subtotal-(($subtotal*$prcode->discountPercent)/100),0,'.','.') }} VNĐ</span></li>
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                    @php
                                        $totalnew = '';
                                        if($discount == 'prcode_01') {
                                           $totalnew = $subtotal;
                                        } else {
                                            $totalnew = $subtotal-(($subtotal*$prcode->discountPercent)/100);
                                        }
                                    @endphp
                                    <input type="hidden" name="totalnew" value="{{ $totalnew }}">
                                    <input type="hidden" name="promoCode" value="{{ $prcode->idPromoCode }}">
                                </ul>
                            </div>
                            <div class="checkout__order__widget">
                                    @if ($errors->has('payment'))
                                    <span class="alert alert-danger notification" style="color: red;">
                                          {{ $errors->first('payment') }}
                                    </span>
                                    @endif
                                <label for="check-payment">
                                    Cheque payment
                                    <input type="checkbox" id="check-payment" name="payment" value="pm_01">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="momo">
                                    Momo
                                    <input type="checkbox" id="momo" name="payment" value="pm_02">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" class="site-btn">Place oder</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->

    {{-- Footer Section Begin --}}
    @include('parts.footer')
    {{-- Footer Section End --}}
    <!-- Js Plugins -->
    {{-- @php
        $success = '';
        if(count($message) > 0)
        $success = @json($message);
    @endphp --}}
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

    {{-- <script>
    //   const noti = {!! json_encode($success) !!}
    //   console.log(noti);
    // console.log(1);
    </script> --}}


</body>

</html>