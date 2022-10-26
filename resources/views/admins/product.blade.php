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
                        <!-- <div class="row"> -->
                        <div class="card">
                            <div class="card-header d-flex justify-content-between justify-content">
                                <p style="font-size: 20px;">
                                    Manage <strong style="margin-left: 2px;"> Product</strong>
                                </p>
                                <!-- 	 <button onclick="loadMore()" class="btn btn-primary">Load more</button>  -->
                                {{-- <c:if test="${sessionScope.p=!NULL}"> --}}
                                <button id="btn-add" type="reset" class="btn btn-primary start-btn "
                                    value="add">Add
                                    new product</button>
                                {{-- </c:if> --}}
                            </div>
                            <div class="card-body">
                                <table id='books' cellpadding='10px' style="text-align: left;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">#</th>
                                            <th style="width: 30%">NAME</th>
                                            <th style="width: 30%; padding-left: 58px">IMAGE</th>
                                            <th style="width: 30%">PRICE</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listProduct as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->nameProduct }}</td>
                                                <td><img class="card-img"
                                                        src="{{ asset('frontend/img/product/' . $item->image . '.jpg') }}"
                                                        alt="" style="width: 50%; padding-left: 0;"></td>
                                                <td>@php
                                                    echo number_format($item->price);
                                                @endphp</td>
                                                <td>
                                                    <div class="btn-action">
                                                        <a href="{{ route('ad.details-product', ['idProduct'=>$item->idProduct]) }}" class="btn-p-detail"> <i
                                                                class="mdi mdi-account-card-details" title="details">
                                                            </i>
                                                        </a>
                                                        <a href="{{ route('ad.edit-product', ['idProduct'=>$item->idProduct]) }}" class="btn-p-edit"> <i
                                                                class="mdi mdi-tooltip-edit" title="edit">
                                                            </i>
                                                        </a>
                                                        <a href="{{ route('ad.delete-product', ['idProduct'=>$item->idProduct]) }}" class="btn-p-delete"> <i class="mdi mdi-delete"
                                                                title="delete"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- @for ($i = 0; $i < 9; $i++) --}}
                                        {{-- @endfor --}}
                                        {{-- <c:forEach items="${listP}" var="o">
											<tr>
												<td>${o.id}</td>
												<td>${o.name}</td>
												<td><img class="card-img" src="${o.image}" alt=""
													style="width: 50%; padding-left: 0;"></td>
												<td>${o.price}$</td>
												<td><div class="btn-action">
													<c:if test="${sessionScope.sp==null}">
														<a href="LoadInfoEdit?pid=${o.id}" class="edit"> <i
															class="fa-solid fa-pen-to-square btn-edit" title="edit">
														</i>
														</a>
													</c:if>
													<c:if test="${sessionScope.sp!=null}">
														<a href="LoadInfoEdit?pid=0" class="edit"> <i
															class="fa-solid fa-pen-to-square btn-edit" title="edit">
														</i>
														</a>
													</c:if>
													<a href="delete?pid=${o.id}" class="delete"> <i
														class="fa-solid fa-trash-can" title="delete"></i>
													</a>
												</div></td>
											</tr>
										</c:forEach> --}}
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="card-footer text-muted d-flex justify-content-between justify-content-center pt-4">
                                <div class="move-slider d-flex justify-content-center">
                                </div>
                            </div>
                            <div class="row col-lg-12 text-center d-flex justify-content-center mt-3">
                                {{ $listProduct->links('parts.pagination') }}
                            </div>
                        </div>
                        <!-- </div> -->
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

    <!-- popup add -->
    <div class="wr-popup" id="w-popup-add">
        <div class="center modal-box">
            <div id="t-btn">
                <label for="" style="padding-left: 30px; font-size: 18px;">Add
                    product</label>
            </div>

            <!--cancle button-->
            <div><i class="fa fa-times cancel"></i></div>

            <div class="form_container" id="ct-form">
                <form name="form" action="{{ route('ad.add-product') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- name,image input box-->
                    <div class="form_wrap form_grp">
                        <div class="form_item">
                            <label>Name</label> <input type="text" name="nameProduct" autocomplete="off">
                        </div>
                        <div class="form_item">
                            <label>Trademark</label> <select name="trademark">
                                @foreach ($listTrademark as $item)
                                    <option value="{{ $item->idTrademark }}">{{ $item->nameTrademark }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- quantity,price input box-->
                    <div class="form_wrap form_grp">
                        <div class="form_item">
                            <label>Quantity</label> <input type="number" name="quantity">
                        </div>
                        <div class="form_item">
                            <label>Price</label> <input type="number" name="price">
                        </div>
                    </div>

                    {{-- type,sale --}}
                    <div class="form_wrap form_grp">
                        <div class="form_item">
                            <label>type</label>
                            <select name="type">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="form_item">
                            <label>sale</label> <input type="number" name="sale">
                        </div>
                    </div>
                    <!--image-->
                    <div class="form_wrap">
                        <div class="form_item">
                            <label>Image</label> <input type="file" name="imageProduct">
                        </div>
                    </div>
                    <!--Description no input-->
                    <div class="form_wrap">
                        <div class="form_item">
                            <label>Description</label>
                            <textarea name="description" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <!--submit button-->
                    <div class="btn-submit pl-0">
                        <input type="submit" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end popup add -->
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
