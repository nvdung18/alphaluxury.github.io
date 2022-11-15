<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personel Page</title>

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

    @include('parts.pre_loader')

    @include('parts.off_canvas_menu')

    @include('parts.header')

    <div class="dfgds">
        <div class="container">
            <div class="row d-flex justify-content-center row-detail-order">
                <div class="back-userpage">
                    <a href="{{ route('user.page') }}" class="btn-back-userpage"><i class="arrow_carrot-left"></i>
                        <p>Go back</p>
                    </a>
                </div>
                <div class="order-detail col-lg-10">
                    @php
                        $nowIdOrder = '';
                    @endphp
                    @foreach ($order as $key => $item)
                        @if ($nowIdOrder != $item['idOrder'])
                            @php
                                $nowIdOrder = $item['idOrder'];
                            @endphp
                            <div class="order-detail">
                                <div class="order-header">
                                    <div class="order-header-items">
                                        <div>
                                            <div class="uppercase font-bold">Order ID:
                                                <strong>{{ $item['idOrder'] }}</strong>
                                            </div>
                                        </div>
                                        <div>
                                            @php
                                                // get status of this order
                                                $statusOrder = json_decode($item["status"]);
                                                foreach ($statusOrder as $key => $value) {
                                                    $lenghtOfStatus = $key;
                                                }
                                                $nowStatusOrder = end($statusOrder->$lenghtOfStatus);
                                                
                                                // to get list product of order to for detail order button
                                                $listDetailProduct = [];
                                            @endphp
                                            <div class="uppercase font-bold"><strong>{{ $nowStatusOrder }}</strong>
                                            </div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-middle">
                                    <div class="order-infor">
                                        <div class="order-infor_address col-md-6">
                                            <strong>Delivery address:</strong>
                                            <p>{{ $checkout[0]->recipientName }}</p>
                                            <p>{{ $checkout[0]->recipientPhoneNumber }}</p>
                                            <p>{{ $checkout[0]->recipientEmail }}</p>
                                            <p>{{ $checkout[0]->recipientAddress }}</p>
                                        </div>
                                        <div class="order-infor_progress-status col-md-6">
                                            @php
                                                $listStatus = ['Wait for confirmation', 'Order confirmed', 'Delivering', 'Order deliveried'];
                                                $statusOrder = json_decode($item['status']);
                                                // to know what step is the current step
                                                $num = 0;
                                            @endphp
                                            <div class="wrapper">
                                                <ul class="StepProgress">
                                                    @foreach ($statusOrder as $key => $itemStatus)
                                                        @if ($itemStatus[2] == $listStatus[$key - 1])
                                                            @if (next($itemStatus))
                                                                <li class="StepProgress-item is-done">
                                                                    <strong>{{ $itemStatus[1] . ' ' . $itemStatus[0] }}</strong>
                                                                    {{ $itemStatus[2] }}
                                                                </li>
                                                            @else
                                                                <li class="StepProgress-item current">
                                                                    <strong>{{ $itemStatus[1] . ' ' . $itemStatus[0] }}</strong>
                                                                    {{ $itemStatus[2] }}
                                                                </li>
                                                            @endif
                                                            @php
                                                                $num++;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    @if ($num < 4)
                                                        <li class="StepProgress-item current">
                                                            <strong>{{ $listStatus[$num] }}</strong></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-products">
                                        @foreach ($order as $key2 => $item2)
                                            @if ($nowIdOrder == $item2['idOrder'])
                                                @php
                                                    // to get list product of order to for detail order button
                                                    array_push($listDetailProduct, $item2);
                                                @endphp
                                                <div class="order-product-item">
                                                    <div><img
                                                            src="{{ asset('frontend/img/product/' . $item2['image']) }}"
                                                            alt="Product Image">
                                                    </div>
                                                    <div>
                                                        <div><a href="#">{{ $item2['nameProduct'] }}</a>
                                                        </div>
                                                        <div>Quantity: {{ $item2['quantity'] }}</div>
                                                        <div>Price:
                                                            {{ number_format($item2['quantity'] * $item2['price']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="order-bottom card">
                                    <div class="card-body order-bottom-body">
                                        <div class="order-bottom_total total_ele">
                                            Total product:
                                            <strong>{{ number_format($item['productMoney']) }}Đ</strong>
                                        </div>
                                        <div class="order-bottom_total total_ele">
                                            Charge delivery:
                                            <strong>{{ number_format($item['deliveryCharges']) }}Đ</strong>
                                        </div>
                                        <div class="order-bottom_total total_ele">
                                            Discount:
                                            <strong>{{ number_format($item['discountPercent']) }}%</strong>
                                        </div>
                                        <div class="order-bottom_total">
                                            Total:
                                            <strong>{{ number_format($item['deliveryCharges'] + $item['productMoney'] - (float) (($item['productMoney'] * $item['discountPercent']) / 100)) }}Đ</strong>
                                        </div>
                                        <div class="order-bottom_btn-order">
                                            <a href="#"
                                                class="mr-3 btn btn-warning btn-buy_again btn-order-more">Buy
                                                again</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-payment card">
                                    <div class="card-body order-payment-body">
                                        <p>Payment methods: </p><strong> {{ $payment[0]->namePayment }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('parts.footer')

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
    <script type="text/javascript"></script>
</body>

</html>
