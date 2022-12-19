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
                    <div class="container wr-manage">
                        <div class="row details-infor">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="page-header" style="margin-bottom: 7px;">
                                        <h3 class="page-title" style="margin-left: 10px; margin-top: 10px">Information
                                            of user</h3>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1">@</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                      </div>
                                      
                                      <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                          <span class="input-group-text" id="basic-addon2">@example.com</span>
                                        </div>
                                      </div>
                                      
                                      <label for="basic-url">Your vanity URL</label>
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                                        </div>
                                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                      </div>
                                      
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-append">
                                          <span class="input-group-text">.00</span>
                                        </div>
                                      </div>
                                      
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">With textarea</span>
                                        </div>
                                        <textarea class="form-control" aria-label="With textarea"></textarea>
                                      </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                <!-- partial:partials/_footer.html -->
                @include('parts_admin.footer')
                <!-- partial -->
            </div>
            <!-- content-wrapper ends -->
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
