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
                            <h3 class="page-title">
                                <span class="page-title-icon bg-gradient-primary text-white me-2">
                                    <i class="mdi mdi-chart-bar"></i>
                                </span> Detail product
                            </h3>
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <span></span>Overview <i
                                            class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body detail-p">
                                        @foreach ($product as $key => $item)
                                            <div class="detail-p__elebasic details-p-top">
                                                {{-- <div class="detail-p__elebasic__img col-md-4"> --}}
                                                <img class="detail-p__elebasic__img "
                                                    src="{{ asset('frontend/img/product/' . $item->image) }}"
                                                    alt="">
                                                {{-- </div> --}}
                                                <div class="detail-p__elebasic__infor ">
                                                    <div class="detail-p__elebasic__name">
                                                        <h4 class="card-title">Name: {{ $item->nameProduct }}</h4>
                                                    </div>
                                                    <div class="detail-p__elebasic__img">
                                                        <h4 class="card-title">Price: @php
                                                            echo number_format($item->price);
                                                        @endphp</h4>
                                                    </div>
                                                    <div class="detail-p__elebasic__type">
                                                        <h4 class="card-title">Type: {{ $item->type }}</h4>
                                                    </div>
                                                    <div class="detail-p__elebasic__trademark">
                                                        <h4 class="card-title">Trademark: {{ $nameTrademark }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($item->detailsImg != null)
                                                <div class="details-p-middel details-p__imgDetails">
                                                    @php
                                                        $imgDetailArr = json_decode($item->detailsImg, true);
                                                    @endphp
                                                    <img class="detail-p__imgDetails__d "
                                                        src="{{ asset('frontend/img/product/' . $imgDetailArr['nameImgDetail1']) }}"
                                                        alt="">
                                                    <img class="detail-p__imgDetails__d "
                                                        src="{{ asset('frontend/img/product/' . $imgDetailArr['nameImgDetail2']) }}"
                                                        alt="">
                                                </div>
                                            @endif
                                            <div class="details-p__more details-p-bottom">
                                                <div class="detail-p__more__description-qunatity">
                                                    <h4 class="card-title details-p__more__text">Quantity: <p
                                                            class="font-weight-normal">{{ $item->quantity }}</p>
                                                    </h4>
                                                    <h4 class="card-title details-p__more__text">Description: <p
                                                            class="font-weight-normal">{{ $item->description }}</p>
                                                    </h4>
                                                </div>
                                                <div class="detail-p__more__sale-quantitySold">
                                                    <h4 class="card-title details-p__more__text">Sale: <p
                                                            class="font-weight-normal">{{ $item->sale }}</p>
                                                    </h4>
                                                    <h4 class="card-title details-p__more__text">QuantitySold: <p
                                                            class="font-weight-normal">{{ $item->quantitySold }}</p>
                                                    </h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
    <script type="text/javascript">
        $('#btn-add')
            .click(
                function() {
                    $('.modal-box').toggleClass("show-modal");
                    $('.start-btn').toggleClass("show-modal");
                    $('.wr-popup').toggleClass("wr-add-popup");
                    /*  console.log("Add"); */
                    // var b = "1";
                    // document.getElementById("t-btn").innerHTML += `<label for="" style="padding-left: 30px; font-size: 18px;">${b}</label>`
                });
        // active cancle button
        $('.cancel').click(function() {
            $('.modal-box').toggleClass("show-modal");
            $('.start-btn').toggleClass("show-modal");
            $('.wr-popup').toggleClass("wr-add-popup");
        });
    </script>
</body>

</html>
