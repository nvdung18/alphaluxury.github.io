<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <div class="user_page">
        <div class="container">
            <div class="row">
                <ul class="menu col-lg-2">
                    <li class="menu_item active" data-index="1">My Profile</li>
                    <li class="menu_item" data-index="2">My Order</li>
                    <li class="menu_item" data-index="3">Change Password</li>
                </ul>
                <div class="form col-lg-10 active">
                    <label for="" class="label_form">
                        My Profile
                    </label>
                    <form action="{{ route('user.update-infor') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="username">UserName</label>
                            <input type="text" class="form-control" id="fullname" placeholder="Enter User Name"
                                name="fullname" value="{{ $infor[0]->fullname }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                name="email" value="{{ $infor[0]->email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleAddress">Address</label>
                            <input type="text" class="form-control" id="exampleAddress" placeholder="Enter address"
                                name="address" value="{{ $infor[0]->address }}">
                        </div>
                        <div class="form-group">
                            <label for="examplePhone">PhoneNumber</label>
                            <input type="text" class="form-control" id="examplePhone" placeholder="Enter Phone"
                                name="phoneNumber" value="{{ $infor[0]->phoneNumber }}">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" name="gender" id="gender">
                                <option {{ $infor[0]->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option {{ $infor[0]->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn_form">Submit</button>
                    </form>
                </div>
                <div class="order col-lg-10">
                    <nav class="nav-status-order">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-all"
                                role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-wait"
                                role="tab" aria-controls="nav-profile" aria-selected="false">Wait for
                                confirmation</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                href="#nav-confirmed" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Order confirmed</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                href="#nav-delivering" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Delivering</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                href="#nav-deliveried" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Order deliveried</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                            aria-labelledby="nav-home-tab">@include('parts.order', ['statusCheck' => 'All'])
                        </div>
                        <div class="tab-pane fade" id="nav-wait" role="tabpanel" aria-labelledby="nav-profile-tab">
                            @include('parts.order', ['statusCheck' => 'Wait for confirmation'])</div>
                        <div class="tab-pane fade" id="nav-confirmed" role="tabpanel"
                            aria-labelledby="nav-contact-tab">@include('parts.order', ['statusCheck' => 'Order confirmed'])</div>
                        <div class="tab-pane fade" id="nav-delivering" role="tabpanel"
                            aria-labelledby="nav-contact-tab">@include('parts.order', ['statusCheck' => 'Delivering'])</div>
                        <div class="tab-pane fade" id="nav-deliveried" role="tabpanel"
                            aria-labelledby="nav-contact-tab">@include('parts.order', ['statusCheck' => 'Order deliveried'])</div>
                    </div>
                    {{-- @php
                        $nowIdOrder = '';
                    @endphp
                    @foreach ($listOrder as $key => $item)
                        @if ($nowIdOrder != $item->idOrder)
                            @php
                                $nowIdOrder = $item->idOrder;
                            @endphp
                            <div class="order">
                                <div class="order-header">
                                    <div class="order-header-items">
                                        <div>
                                            <div class="uppercase font-bold">Order ID:
                                                <strong>{{ $item->idOrder }}</strong>
                                            </div>
                                        </div>
                                        <div>
                                            @php
                                                // get status of this order
                                                $statusOrder = json_decode($item->status);
                                                foreach ($statusOrder as $key => $value) {
                                                    $lenghtOfStatus=$key;
                                                }
                                                $nowStatusOrder = end($statusOrder->$lenghtOfStatus);
                                                
                                                // to get list product of order to for detail order button
                                                $listDetailProduct = [];
                                            @endphp
                                            <div class="uppercase font-bold">{{ $nowStatusOrder }}</div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-products order-middle">
                                    @foreach ($listOrder as $key2 => $item2)
                                        @if ($nowIdOrder == $item2->idOrder)
                                            @php
                                                // to get list product of order to for detail order button
                                                array_push($listDetailProduct, $item2);
                                            @endphp
                                            <div class="order-product-item">
                                                <div><img src="{{ asset('frontend/img/product/' . $item2->image) }}"
                                                        alt="Product Image">
                                                </div>
                                                <div>
                                                    <div><a href="#">{{ $item2->nameProduct }}</a>
                                                    </div>
                                                    <div>Quantity: {{ $item2->quantity }}</div>
                                                    <div>Price: {{ number_format($item2->quantity * $item2->price) }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="order-bottom card">
                                    <div class="card-body order-bottom-body">
                                        <div class="order-bottom_total">
                                            Total:
                                            <strong>{{ number_format($item->deliveryCharges + $item->productMoney - (float) (($item->productMoney * $item->discountPercent) / 100)) }}Đ</strong>
                                        </div>
                                        <div class="order-bottom_btn-order">
                                            <a href="#"
                                                class="mr-3 btn btn-warning btn-buy_again btn-order-more">Buy
                                                again</a>
                                            <a href="{{ route('user.detail-order', ['listDetailProduct' => $listDetailProduct]) }}"
                                                class="btn btn-light btn-details btn-order-more">Order
                                                Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach --}}
                </div>
                <div class="changepassword col-lg-10">
                    <label for="" class="label_form">
                        Change Password
                    </label>
                    <form action="{{ route('user.updatePassword') }}" method="POST">
                        @csrf
                        @if (session('messagepassword'))
                            <input type="hidden" name="messagepassword" value="{{ session('messagepassword') }}">
                            <span class="alert alert-danger notification-user-pass" style="color: red;">
                                {{ session('messagepassword') }}
                            </span>
                        @endif
                        <div class="form-group">
                            <label for="username">New Password</label>
                            <input type="password" class="form-control" id=""
                                placeholder="Enter New Password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input type="password" class="form-control" id=""
                                placeholder="Confirm New Password " name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary btn_form">ChangePassword</button>
                    </form>
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
    {{-- <script type="text/javascript">
    console.log('123123');
    </script> --}}
</body>

</html>
