<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Alpha Admin</title>
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
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('frontend_admin/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <!-- End layout styles -->
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
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-chart-bar"></i>
                            </span> Revenue
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
                                <div class="card-body">
                                    <div class="top-rev d-flex flex-row">
                                        <h4 class="card-title col-md-9">Revenue Table</h4>
                                        <div class="top-rev_filter col-md-3">
                                            <form action="{{ route('ad.filter-revenue')}}" method="get">
                                                <input type="text" name="table_filter" value="{{$tag}}" hidden>
                                                <input type="date" class="filter-rev" name="filter_date_rev"
                                                    id="">
                                                <input type="submit" name="" id=""
                                                    class="btn btn-success btn-filter-rev" value="Filter">
                                            </form>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 10%">#</th>
                                                <th scope="col" style="width: 20%">Revenue</th>
                                                <th scope="col" style="width: 15%">Quantity</th>
                                                <th scope="col" style="width: 22%">Release Date</th>
                                                <th scope="col" style="width: 23%">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listRev as $key => $item)
                                                @if ($key < 8)
                                                    <tr>
                                                        <th scope="row">{{ $key + 1 }}</th>
                                                        <td>@php
                                                            echo number_format($item->revenue);
                                                        @endphp</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->releaseDate }}</td>
                                                        <td>
                                                            @if ($tag == 'day')
                                                                <a href="#" class="btn-rev-more">
                                                                    <div class="btn btn-primary">
                                                                        Detail
                                                                    </div>
                                                                </a>
                                                            @else
                                                                <a class="btn-rev-more"
                                                                    href="{{ $tag == 'week' 
                                                                    ? route('ad.chart-weekly-revenue', ['position' => $item->position]) 
                                                                    : route('ad.chart-monthly-revenue', ['position' => $item->position]) }}">
                                                                    <div class="btn btn-primary">
                                                                        Statistical
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row col-lg-12 text-center d-flex justify-content-center mt-3">
                                    {{ $listRev->links('parts.pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('parts_admin.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
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
    {{-- chart --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- End custom js for this page -->
</body>

</html>
