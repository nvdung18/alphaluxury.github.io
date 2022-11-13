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
                                    @if ($tag == 'week')
                                        <div id="piechart" style="width: 100%; height: 500px;"></div>
                                    @else
                                        <div id="chart_div" style="width: 100%; height: 500px;"></div>
                                        <div id="table_div"></div>
                                    @endif
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
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var rev = {!! json_encode($rev) !!};
            var tag = {!! json_encode($tag) !!};
            // console.log(tag);
            if (tag == 'week') {
                console.log(1);
                google.charts.load("current", {
                    packages: ["corechart"]
                });
                google.charts.setOnLoadCallback(drawChart);

                var arrRev = [];
                var arrDate = [];
                for (let i = 0; i < 7; i++) {
                    if (rev[i] != null) {
                        arrRev[i] = rev[i].revenue;
                        arrDate[i] = rev[i].releaseDate;
                    } else {
                        arrRev[i] = 0;
                        arrDate[i] = null;
                    }
                }

                console.log(arrRev, arrDate);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Revenue', 'Daily Revenue'],
                        [arrDate[0], arrRev[0]],
                        [arrDate[1], arrRev[1]],
                        [arrDate[2], arrRev[2]],
                        [arrDate[3], arrRev[3]],
                        [arrDate[4], arrRev[4]],
                        [arrDate[5], arrRev[5]],
                        [arrDate[6], arrRev[6]],
                    ]);

                    var options = {
                        title: 'Weekly Revenue of ' + arrDate[0] + ' - ' + arrDate[rev.length - 1],
                        is3D: true,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }
            } else {
                var arrRev = [];
                var arrDate = [];
                var arrQuantity= [];
                console.log(1);
                for (let i = 0; i < 31; i++) {
                    if (rev[i] != null) {
                        arrRev[i] = rev[i].revenue;
                        arrDate[i] = rev[i].releaseDate;
                        arrQuantity[i]=rev[i].quantity;
                    } else {
                        arrRev[i] = 0;
                        // arrDate[i] = null;
                        arrQuantity[i]=0;
                    }
                }

                // get month and year
                const monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];

                const d = new Date(arrDate[0]);

                // console.log(arrDate);
                // console.log(arrRev, monthNames[d.getMonth()],d.getYear()+1900);

                google.charts.load('current', {
                    packages: ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawBasic);

                function drawBasic() {
                    var data = new google.visualization.DataTable();
                    var data = google.visualization.arrayToDataTable([
                        ['Month', 'Revenue', {
                            role: 'style'
                        }],
                        ['1', arrRev[0], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['2', arrRev[1], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['3', arrRev[2], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['4', arrRev[3], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['5', arrRev[4], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['6', arrRev[5], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['7', arrRev[6], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['8', arrRev[7], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['9', arrRev[8], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['10', arrRev[9], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['11', arrRev[10], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['12', arrRev[11], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['13', arrRev[12], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['14', arrRev[13], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['15', arrRev[14], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['16', arrRev[15], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['17', arrRev[16], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['18', arrRev[17], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['19', arrRev[18], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['20', arrRev[19], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['21', arrRev[20], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['22', arrRev[21], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['23', arrRev[22], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['24', arrRev[23], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['25', arrRev[24], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['26', arrRev[25], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['27', arrRev[26], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['28', arrRev[27], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['29', arrRev[28], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['30', arrRev[29], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                        ['31', arrRev[30], ' stroke-width: 2;stroke-color: #5489e2; color: #76A7FA'],
                    ]);

                    var options = {
                        title: monthNames[d.getMonth()]+"'s revenue",
                        hAxis: {
                            title: 'Revenue of ' + monthNames[d.getMonth()] +' '+(d.getYear()+1900),
                        },
                        vAxis: {
                            title: 'Revenue'
                        }
                        // xAxis: {
                        //   title: 'Turnover'
                        // }
                    };

                    var chart = new google.visualization.ColumnChart(
                        document.getElementById('chart_div'));

                    chart.draw(data, options);
                }

                // table chart
                google.charts.load('current', {'packages':['table']});
                google.charts.setOnLoadCallback(drawTable);

                function drawTable() {
                    var data1 = new google.visualization.DataTable();
                    data1.addColumn('string', 'Date');
                    data1.addColumn('number', 'Revenue');
                    data1.addColumn('number', 'Quantity');
                    arrDate.forEach((element,index )=> {
                        data1.addRows([
                            [arrDate[index],  {v: arrRev[index]}, arrQuantity[index] ],
                        ]);
                    });
                    
                    var table = new google.visualization.Table(document.getElementById('table_div'));
                    // data1.setCell(22, 2, 15, 'Fifteen', {style: 'font-style:bold; font-size:22px;'});
                    table.draw(data1, {showRowNumber: true, width: '100%', height: '100%'});
                }


                console.log(arrRev);
            }
        }, false)
    </script>
</body>

</html>
