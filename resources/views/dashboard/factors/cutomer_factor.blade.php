<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <link rel="stylesheet" href="{{asset("dist/css/adminlte.min.css")}}">

    <title>چاپ فاکتور</title>
    <style>
        .table th {
            vertical-align: middle !important;
            text-align: center;
        }

        th {
            font-size: 15px;
        }

        p {
            font-size: 15px
        }
    </style>
</head>
<meta charset="utf-8">
<body class="hold-transition sidebar-mini">
<center>
    <div class="wrapper" style="width: 15cm;max-width: 15cm;position:inherit !important;">
        <center>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="margin-right: 0;margin-left: 0; !important;background: white !important;">
                <div class="content-header">
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row" style="border: 2px solid lightgray;padding: 5px;border-bottom: 0">
                            <div class="col-sm-6">
                                <center>
                                    <br>
                                    <p style="font-size: 15px" class="m-0 text-dark">بار فروشی <br> سیفعلی سیرانی و پسران</p>
                                </center>
                            </div>
                            <div class="col-sm-6" style="text-align: center;font-size: 12px">
                                <center>
                                    <span style="padding-bottom: 0">
                                        تلفن حجره : 52232129 - 041
                                    </span>
                                    <br>
                                    <span>
                                        سیفعلی سیرانی : 09141248299
                                    </span>
                                    <br>
                                    <span>
                                        سعید سیرانی : 09149241945
                                    </span>
                                    <br>
                                    <span>
                                        فرهاد سیرانی : 09148290018
                                    </span>
                                    <br>
                                    <span>
                                        فرزین سیرانی : 09145020488
                                    </span>
                                </center>

                            </div>
                        </div>
                        <div class="row" style="direction: rtl;">
                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px;">
                                <p style="font-size: 12px;text-align: right" class="m-0 text-dark">صورت حساب :
                                    <br>
                                    <b>{{$factor->customer_name}}</b>
                                </p>
                            </div><!-- /.col -->

                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p style="font-size: 12px" class="m-0 text-dark">تاریخ : <b>{{$factor->date}}</b></p>
                            </div>

                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p style="font-size: 12px" class="m-0 text-dark">بدهی قبلی :
                                    <b>{{number_format($factor->last_debt)}}</b></p>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->

                    <br>

                    <div class="container-fluid">
                        <table class="table table-sm table-bordered">
                            <thead>
                            <tr>
                                <th scope="col"> نام کالا</th>
                                <th scope="col"> تعداد</th>
                                <th scope="col">وزن</th>
                                <th scope="col">فی</th>
                                <th scope="col">کل</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($factor_products as $product)
                                <tr>

                                    <th scope="col">{{$product->product_name}}</th>
                                    <th scope="col">{{number_format($product->count)}}</th>
                                    <th scope="col">{{number_format($product->weight)}}</th>
                                    <th scope="col">{{number_format($product->fee)}}</th>
                                    <th scope="col">{{number_format($product->count * $product->weight * $product->fee)}}</th>
                                </tr>
                            @endforeach
                            <tr style="border-top: 2px solid;">
                                <th scope="col">بدهی قبلی</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">{{number_format($factor->last_debt)}}</th>
                            </tr>

                            <tr>
                                <th scope="col">هزینه کارگری</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">{{number_format($factor->worker_paid)}}</th>
                            </tr>
                            <tr style="border-top: 2px solid;">
                                <th scope="col">جمع کل</th>
                                <th scope="col">{{number_format($total_products_count)}}</th>
                                <th scope="col">{{number_format($total_products_weight)}}</th>
                                <th scope="col"></th>
                                <th scope="col">{{number_format($total_products_price + $factor->last_debt + $factor->worker_paid)}}</th>
                            </tr>

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6" style="border: 1px solid lightgray;padding: 10px">
                                <p style="font-size: 12px" class="m-0 text-dark">وجه پرداختی :
                                    <b>{{number_format($factor->paid)}}</b></p>
                            </div>

                            <div class="col-sm-6" style="border: 1px solid lightgray;padding: 10px">
                                <p style="font-size: 12px" class="m-0 text-dark">باقی مانده :
                                    <b>{{number_format($total_products_price + $factor->last_debt + $factor->worker_paid - $factor->paid)}}</b>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12" style="border: 1px solid lightgray;padding: 10px">
                                <p style="font-size: 12px" class="m-0 text-dark"><b>آدرس :میانه میدان تره بار حجره ۱</b>
                                </p>
                            </div><!-- /.col -->

                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

        </center>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
</center>
@include('dashboard.footer')
</body>
</html>
