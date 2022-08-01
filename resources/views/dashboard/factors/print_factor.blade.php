<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset("dist/css/adminlte.min.css")}}">

    <title>چاپ فاکتور</title>
    <style>
        @font-face {
            font-family: Vazir;
            src: url('{{asset("dist/fonts/Vazir.eot")}}');
            src: url('{{asset("dist/fonts/Vazir.eot?#iefix")}}') format('embedded-opentype'),
            url('{{asset("dist/fonts/Vazir.woff2")}}') format('woff2'),
            url('{{asset("dist/fonts/Vazir.woff")}}') format('woff'),
            url('{{asset("dist/fonts/Vazir.ttf")}}') format('truetype');
            font-weight: normal;
        }

        @font-face {
            font-family: Vazir;
            src: url('{{asset("dist/fonts/Vazir-Bold.eot")}}');
            src: url('{{asset("dist/fonts/Vazir-Bold.eot?#iefix")}}') format('embedded-opentype'),
            url('{{asset("dist/fonts/Vazir-Bold.woff2")}}') format('woff2'),
            url('{{asset("dist/fonts/Vazir-Bold.woff")}}') format('woff'),
            url('{{asset("dist/fonts/Vazir-Bold.ttf")}}') format('truetype');
            font-weight: bold;
        }
        
        body {
            direction: rtl;
            text-align: right;
            font-family: 'Vazir', sans-serif !important;
        }


        ul {
            padding-inline-start: 0px;
        }

        .content-wrapper{
            transition: margin-right .3s ease-in-out;
            margin-right: 250px;
            margin-left : 0;
            z-index: 3000;
        }

        th {
            vertical-align: middle !important;
            text-align: center;
        }
        th{
            font-size: 12px;
        }
    </style>
</head>
<meta charset="utf-8">
<body class="hold-transition sidebar-mini" style="width: 148mm;">
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-right: 0; !important;background: white !important;">
        <div class="content-header">
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="border: 2px solid lightgray;padding: 20px">
                    <div class="col-sm-2">
                        <center>
                            <p style="font-size: 10px">بسمه تعالی</p>
                        </center>
                    </div>

                    <div class="col-sm-5">
                        <center>
                            <h6 class="m-0 text-dark">بار فروشی <br> سیفعلی سیرانی و پسران</h6>
                        </center>
                    </div><!-- /.col -->
                    <div class="col-sm-4" style="text-align: center;font-size: 10px">
                        <center>
                            <label>
                                تلفن حجره : 2232129 - 0423
                            </label>
                            <label>
                                سیفعلی سیرانی : 09141248299
                            </label>
                            <label>
                                سعید سیرانی : 09149241945
                            </label>
                            <label>
                                فرهاد سیرانی : 09148290018
                            </label>
                            <label>
                                فرزین سیرانی : 09148290018
                            </label>
                        </center>

                    </div><!-- /.col -->
                </div>
                <br>

                <div class="row" style="direction: rtl">
                    <div class="col-sm-6" style="border: 1px solid lightgray;padding: 10px">
                        <p style="font-size: 12px;text-align: right" class="m-0 text-dark">صورت حساب :
                            <b>{{$factor->customer_name}}</b>
                        </p>
                    </div><!-- /.col -->

                    <div class="col-sm-3" style="border: 1px solid lightgray;padding: 10px">
                        <p style="font-size: 12px" class="m-0 text-dark">تاریخ : <b>{{$factor->date}}</b></p>
                    </div>

                    <div class="col-sm-3" style="border: 1px solid lightgray;padding: 10px">
                        <p style="font-size: 12px" class="m-0 text-dark">بدهی قبلی :
                            <b>{{number_format($factor->last_debt)}}</b></p>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <div class="container-fluid " style="overflow-x:auto;">
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
                    <hr>
                    <tr style="border-top: 2px solid;">
                        <th scope="col">جمع کل</th>
                        <th scope="col">{{number_format($total_products_count)}}</th>
                        <th scope="col">{{number_format($total_products_weight)}}</th>
                        <th scope="col"></th>
                        <th scope="col">{{number_format($total_products_price + $factor->last_debt + $factor->worker_paid)}}</th>
                    </tr>

                    </tbody>
                </table>
                <br>
                <div class="row">
                    <div class="col-sm-6" style="border: 1px solid lightgray;padding: 10px">
                        <p style="font-size: 12px" class="m-0 text-dark">وجه پرداختی : <b>{{number_format($factor->paid)}}</b></p>
                    </div>

                    <div class="col-sm-6" style="border: 1px solid lightgray;padding: 10px">
                        <p style="font-size: 12px" class="m-0 text-dark">باقی مانده :
                            <b>{{number_format($total_products_price + $factor->last_debt + $factor->worker_paid - $factor->paid)}}</b>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12" style="border: 1px solid lightgray;padding: 10px">
                        <p style="font-size: 12px" class="m-0 text-dark"><b>آدرس :میانه میدان تره بار حجره ۱</b></p>
                    </div><!-- /.col -->

                </div>
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

</body>
</html>
