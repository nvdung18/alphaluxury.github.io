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
                        <div class="card">
                            <div class="card-header d-flex justify-content-between justify-content">
                                <div class="right-header d-flex">
                                    <p style="font-size: 20px;  margin-right: 20px;">
                                        Manage <strong style="margin-left: 2px;"> Order</strong>
                                    </p>
                                    <div class="search-field field-order d-none d-md-block ">
                                        <form class="d-flex align-items-center h-100" action="{{ route('ad.search-order') }}" method="GET">
                                            {{-- <input type="text" name="" id=""> --}}
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                                                    <button type="submit" style="border: 0px; padding: 0px;"><i class="input-group-text border-0 mdi mdi-magnify"></i></button>
                                                    {{-- <i class="input-group-text border-0 mdi mdi-magnify"></i> --}}
                                                </div>
                                                <input type="text" class="form-control bg-transparent border-0 input-search-order" placeholder="Search" name="input_search_order">
                                                {{-- <button type="submit"><i class="input-group-text border-0 mdi mdi-magnify"></i></button> --}}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="top-rev_filter col-md-3">
                                    <form action="{{ route('ad.filter-order')}}" method="get">
                                        <input type="date" class="filter-rev" name="filter_date_order"
                                            id="">
                                        <input type="submit" name="" id=""
                                            class="btn btn-success btn-filter-rev" value="Filter">
                                    </form>
                                </div>
                                {{-- <div class="style-select ">
                                    <div class="select-box">
                                        <div class="options-container-branch">
                                            <a href="">
                                                <div class="option-branch">
                                                    <p>dsafdsaf</p>
                                                </div>
                                            </a>
                                            <a href="">
                                                <div class="option-branch">
                                                    <p>dsafdsaf</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="selected-branch">
                                            sdfasdf
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="card-body ">
                                <table id='books' cellpadding='10px' style="text-align: left;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">ID ORDER</th>
                                            <th style="width: 20%">RECIPIENT</th>
                                            <th style="width: 15%">TOTAL PRODUCT</th>
                                            <th style="width: 15%">FORM PAYMENT</th>
                                            <th style="width: 40%">STATUS</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listOrder as $key => $item)
                                            <tr>
                                                <td>{{ $item->idOrder }}</td>
                                                <td>{{ $listCheckout[$key][0]->recipientName }}</td>
                                                <td>@php
                                                    echo number_format($item->totalMoney);
                                                @endphp </td>
                                                <td>{{ $listPayment[$key][0]->namePayment }}</td>
                                                <td>
                                                    <form class="status-order" method="POST"
                                                        action="{{ route('ad.update-order', ['idOrder' => $item->idOrder]) }}">
                                                        @csrf
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text"
                                                                    for="inputGroupSelect01">Options</label>
                                                            </div>
                                                            <select class="custom-select status-order_selected"
                                                                id="inputGroupSelect01" name="status">
                                                                @php
                                                                    $status = json_decode($item->status);
                                                                    $maxKey = 0;
                                                                    foreach ($status as $key => $itemSt) {
                                                                        $maxKey = $key;
                                                                    }
                                                                    $status = $status->$maxKey[2];
                                                                    $keyStatusSelected = -10;
                                                                @endphp
                                                                @foreach ($listStatus as $keyStatus => $value)
                                                                    @if ($status == $value)
                                                                        <option selected disabled>{{ $value }}
                                                                        </option>
                                                                        @php
                                                                            $keyStatusSelected = $keyStatus;
                                                                        @endphp
                                                                    @else
                                                                        @if ($keyStatus == $keyStatusSelected + 1)
                                                                            <option>{{ $value }}</option>
                                                                        @else
                                                                            <option disabled>{{ $value }}
                                                                            </option>
                                                                        @endif
                                                                    @endif
                                                                    {{-- <option {{$status==$value ? 'selected' : 'disabled'}}>{{$value}}</option> --}}
                                                                    {{-- <option value="1">{{$listStatus['2']}}
                                                                    </option>
                                                                    <option value="2">{{$listStatus['3']}}
                                                                    </option>
                                                                    <option value="3">{{$listStatus['4']}} --}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="submit ml-3"
                                                            class="btn btn-primary status-order_btn-confirm"
                                                            {{ $status == 'Order deliveried' ? 'disabled' : '' }}>Confirm</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="btn-action">
                                                        <a href="{{ route('ad.details-order', ['idOrder' => $item->idOrder,'tag'=>'order']) }}"
                                                            class="btn-p-detail"> <i
                                                                class="mdi mdi-account-card-details" title="details">
                                                            </i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="card-footer text-muted d-flex justify-content-between justify-content-center pt-4">
                                <div class="move-slider d-flex justify-content-center">
                                </div>
                            </div>
                            <div class="row col-lg-12 text-center d-flex justify-content-center mt-3">
                                {{ $listOrder->links('parts.pagination') }}
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
        const selectedBranch = document.querySelector(".selected-branch");
        const optionsContainerBranch = document.querySelector(".options-container-branch");

        const optionsListBranch = document.querySelectorAll(".option-branch");

        if (selectedBranch) {
            selectedBranch.addEventListener("click", () => {
                optionsContainerBranch.classList.toggle("active");
            });

        }

        optionsListBranch.forEach(o => {
            o.addEventListener("click", () => {
                selectedBranch.innerHTML = o.querySelector("a").innerHTML;
                optionsContainerBranch.classList.remove("active");
            });
        });
    </script>
</body>

</html>
