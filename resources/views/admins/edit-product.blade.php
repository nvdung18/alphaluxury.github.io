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
                                </span> Delete product
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
                                    <div class="card-body ">
                                        @foreach ($product as $keyv => $value)
                                            <form action="{{ route('ad.edit-product' ,['idProduct'=>$value->idProduct]) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <h2>{{ $value->nameProduct }}</h2>
                                                <div class="form-group">
                                                    <label for="">Name Product</label>
                                                    <input type="text" name="nameProduct" id="name-product"
                                                        class="form-control" placeholder="Name Product"
                                                        aria-describedby="helpId" value="{{ $value->nameProduct }}">
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text lb-trademark"
                                                                for="inputTrademark">Trademark</label>
                                                        </div>
                                                        <select class="custom-select" id="inputTrademark"
                                                            name="trademark">
                                                            @foreach ($listTrademark as $item)
                                                                <option value="{{ $item->idTrademark }}" {{$idTrademark==$item->idTrademark ? 'selected' :''}}>
                                                                    {{ $item->nameTrademark }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""> Price</label>
                                                    <input type="number" name="price" id="price"
                                                        class="form-control" placeholder="Price"
                                                        aria-describedby="helpId" value="{{ $value->price }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""> Description</label>
                                                    <textarea name="description" id="" cols="30" rows="10" placeholder="Description">{{ $value->description }} </textarea>
                                                    {{-- <input type="area" name="button_text" id="button_text"
                                                        class="form-control" placeholder="Mo ta slide"
                                                        aria-describedby="helpId" value="{{ $value->description }}"> --}}
                                                </div>
                                                <div class="form-group">
                                                    <label for=""> Type</label>
                                                    <input type="text" name="type" id="type"
                                                        class="form-control" placeholder="Type"
                                                        aria-describedby="helpId" value="{{ $value->type }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""> Quantity</label>
                                                    <input type="number" name="quantity" id="quantity"
                                                        class="form-control" placeholder="Quantity"
                                                        aria-describedby="helpId" value="{{ $value->quantity }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""> Sale</label>
                                                    <input type="number" name="sale" id="sale"
                                                        class="form-control" placeholder="Sale"
                                                        aria-describedby="helpId" value="{{ $value->sale }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Curruent Image </label>
                                                    <img class=""
                                                        src="{{ asset('frontend/img/product/' . $value->image . '.jpg') }}"
                                                        alt="" style="width: 20%">
                                                    <input type="hidden" name="img_p_old"
                                                        value="{{ $value->image }}">
                                                    <input type="file" name="imageProduct" id=""
                                                        class="form-control" placeholder=""
                                                        aria-describedby="helpId">
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" id="submit"
                                                        class="form-control btn btn-outline-info"
                                                        aria-describedby="helpId" value="Lưu">
                                                </div>
                                            </form>
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
