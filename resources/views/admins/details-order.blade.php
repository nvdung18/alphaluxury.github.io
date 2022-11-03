<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('frontend_admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_adminvendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('frontend_admin/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('frontend_admin/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('frontend_admin/css/ad_style.css') }}">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('parts_admin.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('parts_admin.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- <div class="wr-ct-manage"> -->
                    <div class="container wr-manage">
                        <div class="page-header">
                            <h3 class="page-title" style="font-size: 25px">Detail Order
                                #{{ $idOrder }}</h3>
                        </div>
                        <div class="row details-order">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="page-header" style="margin-bottom: 7px;">
                                        <h3 class="page-title" style="margin-left: 10px; margin-top: 10px">Information
                                            of user</h3>
                                    </div>
                                    <table id='books' cellspacing="0" cellpadding="5" style="text-align: left;"
                                        border="1">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%">Name</th>
                                                <th style="width: 10%">Phone</th>
                                                <th style="width: 40%">Address</th>
                                                <th style="width: 40%">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($checkout as $item)
                                                <tr>
                                                    <td>{{ $item->recipientName }}</td>
                                                    <td>{{ $item->recipientPhoneNumber }}</td>
                                                    <td>{{ $item->recipientAddress }}</td>
                                                    <td>{{ $item->recipientEmail }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row details-order">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="page-header" style="margin-bottom: 7px;">
                                        <h3 class="page-title" style="margin-left: 10px; margin-top: 10px">Detail
                                            Receipt</h3>
                                    </div>
                                    <table id='books' cellspacing="0" cellpadding="5" style="text-align: left;"
                                        border="1">
                                        <thead>
                                            <tr>
                                                <th style="width: 55%">Product</th>
                                                <th style="width: 5%">Amount</th>
                                                <th style="width: 20%%">Unit price</th>
                                                <th style="width: 25%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detailsOrder as $item)
                                                @foreach ($listInforProduct as $key => $value)
                                                    @if ($item->idProduct == $value['0']->idProduct)
                                                        <tr>
                                                            <td>
                                                                <img class="card-img"
                                                                    src="{{ asset('frontend/img/product/' . $value['0']->image) }}"
                                                                    alt="" style="width: 8%; padding-left: 0;">
                                                                {{ $value['0']->nameProduct }}
                                                            </td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>@php
                                                                echo number_format($value['0']->price);
                                                            @endphp</td>
                                                            <td>@php
                                                                echo number_format($value['0']->price * $item->quantity);
                                                            @endphp</td>
                                                        </tr>
                                                    @break
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row details-order">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="page-header" style="margin-bottom: 7px;">
                                    <h3 class="page-title" style="margin-left: 10px; margin-top: 10px">Total payment
                                    </h3>
                                </div>
                                <table id='books' cellspacing="0" cellpadding="5" style="text-align: left;"
                                    border="1">
                                    <!-- <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead> -->
                                    @foreach ($order as $item)
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Total Product
                                                </td>
                                                <td>
                                                    @php
                                                        echo number_format($item->productMoney);
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Shipping fee
                                                </td>
                                                <td>
                                                    @php
                                                        echo number_format($item->deliveryCharges);
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Promotion
                                                </td>
                                                <td>
                                                    {{ $promotionProduct }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    VAT
                                                </td>
                                                <td>
                                                    0
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Total payment</strong>
                                                </td>
                                                <td>
                                                    @php
                                                        echo number_format($item->productMoney+$promotionProduct+$item->deliveryCharges);
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Form payment
                                                </td>
                                                <td>
                                                    @foreach ($payment as $value)
                                                        {{$value->namePayment}}
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @include('parts_admin.footer')
            <!-- partial -->
        </div>
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->


{{-- </div> --}}
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('frontend_admin/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('frontend_admin/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('frontend_admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('frontend_admin/js/off-canvas.js') }}"></script>
<script src="{{ asset('frontend_admin/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('frontend_admin/js/misc.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('frontend_admin/js/dashboard.js') }}"></script>
<script src="{{ asset('frontend_admin/js/todolist.js') }}"></script>
<!-- End custom js for this page -->
<script type="text/javascript"></script>
</body>

</html>
