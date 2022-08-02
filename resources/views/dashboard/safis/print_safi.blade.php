<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <link rel="stylesheet" href="{{asset("dist/css/adminlte.min.css")}}">

    <title>چاپ فاکتور صافی</title>
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
    <div class="wrapper" style="width: 20cm;max-width: 20cm;position:inherit !important;">
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
                                    <p style="font-size: 15px" class="m-0 text-dark">بار فروشی <br> سیفعلی سیرانی و
                                        پسران
                                    </p>
                                </center>
                            </div>
                            <div class="col-sm-6" style="text-align: center;font-size: 13px">
                                <center>
                                    <span style="padding-bottom: 0">
                                        تلفن حجره : 2232129 - 0423
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
                                        فرزین سیرانی : 09148290018
                                    </span>
                                </center>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p class="m-0 text-dark">صورت حساب : <b>{{$safi->load_owner_name}}</b></p>
                            </div><!-- /.col -->

                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p class="m-0 text-dark">تاریخ : <b>{{$safi->date}}</b></p>
                            </div>

                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p class="m-0 text-dark">توسط راننده : <b>{{$safi->load_driver}}</b></p>
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
                            @foreach($safi_products as $product)
                                <tr>
                                    <th scope="col">{{$product->product_name}}</th>
                                    <th scope="col">{{number_format($product->count)}}</th>
                                    <th scope="col">{{number_format($product->weight)}}</th>
                                    <th scope="col">{{number_format($product->fee)}}</th>
                                    <th scope="col">{{number_format($product->count * $product->weight * $product->fee)}}</th>
                                </tr>
                            @endforeach
                            <th scope="col">جمع کل</th>
                            <th scope="col">{{number_format($total_products_count)}}</th>
                            <th scope="col">{{number_format($total_products_weight)}}</th>
                            <th scope="col"></th>
                            <th scope="col">{{number_format($total_products_price)}}</th>

                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p class="m-0 text-dark">حق العمل : <b>{{number_format($safi->do_price)}}</b></p>
                            </div><!-- /.col -->

                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p class="m-0 text-dark">کرایه : <b>{{number_format($safi->hire)}}</b></p>
                            </div>

                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p class="m-0 text-dark">تخلیه : <b>{{number_format($safi->discharge)}}</b></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p class="m-0 text-dark">باسکول : <b>{{number_format($safi->weighbridge)}}</b></p>
                            </div><!-- /.col -->

                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p class="m-0 text-dark">دستی : <b>{{number_format($safi->handy)}}</b></p>
                            </div>

                            <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                                <p class="m-0 text-dark">
                                    مبلغ الباقی : <b>
                                        {{number_format($total_products_price - (
                                            $safi->do_price + $safi->hire + $safi->discharge + $safi->weighbridge + $safi->handy
                                        ))}}
                                    </b></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12" style="border: 1px solid lightgray;padding: 10px">
                                <p class="m-0 text-dark"><b>آدرس :میانه میدان تره بار حجره ۱</b></p>
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
</center>
<!-- ./wrapper -->

<!-- jQuery -->
@include('dashboard.footer')
</body>
</html>
