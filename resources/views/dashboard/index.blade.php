<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>داشبرد مدیریت</title>
    <script src="{{asset('js/separate-number.js')}}" defer></script>
    <script src="{{asset('js/Chart.min.js')}}"></script>


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('dashboard.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">داشبرد</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h5>{{$family_member_count}}</h5>

                                <p>تعداد اعضای</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h5>{{number_format($total_last_week_transaction)}}</h5>

                                <p>خرج کل هفته جاری</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-text-o"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                @if(!is_null($most_spender_among_users_in_week))
                                    <h5>{{$most_spender_among_users_in_week->name}}
                                        <small>({{number_format($most_spender_among_users_in_week->each_person_total_price)}}
                                            )</small></h5>
                                @else
                                    <h5>خریدی ثبت نشده است</h5>
                                @endif
                                <p>پرخرج ترین عضو هفته</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-usd"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                @if(!is_null($most_expensive_expense))
                                    <h5>{{number_format($most_expensive_expense->price)}}<small>
                                            ({{$most_expensive_expense->title}})</small></h5>

                                @else
                                    <h5>خریدی ثبت نشده است</h5>
                                @endif
                                <p>بیشترین خرج هفته</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dropbox"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <section class="col-lg-7 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3">
                                    <i class="fa fa-pie-chart mr-1"></i>
                                    هزینه خرید های روزانه هفته جاری
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <canvas id="myChart" style="width:100%;max-width:600px;max-height: 400px"></canvas>
                            </div>
                        </div>
                        <!-- /.card -->
                    </section>

                    <section class="col-lg-5 connectedSortable">
                        <!-- Map card -->
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3">
                                    <i class="fa fa-pie-chart mr-1"></i>
                                    دسته بندی اهمیت خرید ها
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body" style="padding: 0">
                                <canvas height="250px" id="myChart2"
                                        style="width:100%;max-width:600px;max-height: 400px"></canvas>
                            </div>
                        </div>
                        <!-- /.card -->
                    </section>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('dashboard.footer')
<script>
    let factor_data = JSON.parse(' {!! $transactions_sum_price_day_based !!} ');
    var factor_xValues = [];
    var factor_yValues = [];
    Object.entries(factor_data).forEach(([key, value], index) => {
        factor_xValues.push(key.substring(5))
        factor_yValues.push(value)
    });

    new Chart("myChart", {
        type: "line",
        data: {
            labels: factor_xValues,
            datasets: [{
                data: factor_yValues,
                borderColor: "green",
                fill: false
            }]
        },
        options: {
            legend: {display: false}
        }
    });


    let customer_data = JSON.parse(' {!! $transaction_importance_count !!} ');
    let total = 0;
    var customer_xValues = [];
    var customer_yValues = [];
    var barColors = ["lightblue", "blue", "yellow", "orange", "red"];
    Object.entries(customer_data).forEach(([key, value], index) => {
        customer_xValues.push(value['kind']);
        customer_yValues.push(value['count']);
        total += value['count'];
    });
    if (total !== 0) {


        new Chart("myChart2", {
            type: "pie",
            data: {
                labels: customer_xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: customer_yValues
                }]
            },
            options: {
                title: {
                    display: true,
                }
            }
        });
    }
</script>
</body>
</html>
