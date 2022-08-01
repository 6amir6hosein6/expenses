
<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>چاپ فاکتور صافی</title>
    <script src="{{asset('js/separate-number.js')}}"></script>
</head>
<style>
    .table th {
        vertical-align: middle !important;
        text-align: center;
    }
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-right: 0; !important;background: white !important;">
        <div class="content-header">
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="border: 2px solid lightgray;padding: 20px">
                    <div class="col-sm-3">
                        <center>
                            <h6>بسمه تعالی</h6>
                        </center>
                    </div>

                    <div class="col-sm-6">
                        <center>
                            <h4 class="m-0 text-dark">بار فروشی <br> سیفعلی سیرانی و پسران</h4>
                        </center>
                    </div><!-- /.col -->

                    <div class="col-sm-3" style="text-align: center;">
                        <center>

                            <h6>
                                تلفن حجره : 2232129 - 0423
                            </h6>
                            <h6>
                                همراه : 09141248299
                            </h6>
                            <h6>
                                09149241945
                            </h6>
                            <h6>
                                09148290018
                            </h6>
                        </center>

                    </div><!-- /.col -->

                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                        <h5 class="m-0 text-dark">صورت حساب : <b>{{$safi->load_owner_name}}</b></h5>
                    </div><!-- /.col -->

                    <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                        <h5 class="m-0 text-dark">تاریخ : <b>{{$safi->date}}</b></h5>
                    </div>

                    <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                        <h5 class="m-0 text-dark">توسط راننده : <b>{{$safi->load_driver}}</b></h5>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <br>

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
                    @foreach($safi_products as $product)
                        <tr>
                            <th scope="col">{{$product->product_name}}</th>
                            <th scope="col" >{{number_format($product->count)}}</th>
                            <th scope="col">{{number_format($product->weight)}}</th>
                            <th scope="col">{{number_format($product->fee)}}</th>
                            <th scope="col">{{number_format($product->count * $product->weight * $product->fee)}}</th>
                        </tr>
                    @endforeach
                    <th scope="col">جمع کل</th>
                    <th scope="col" >{{number_format($total_products_count)}}</th>
                    <th scope="col">{{number_format($total_products_weight)}}</th>
                    <th scope="col"></th>
                    <th scope="col">{{number_format($total_products_price)}}</th>

                    </tbody>
                </table>

                <div class="row">
                    <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                        <h5 class="m-0 text-dark">حق العمل : <b>{{number_format($safi->do_price)}}</b></h5>
                    </div><!-- /.col -->

                    <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                        <h5 class="m-0 text-dark">کرایه : <b>{{number_format($safi->hire)}}</b></h5>
                    </div>

                    <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                        <h5 class="m-0 text-dark">تخلیه : <b>{{number_format($safi->discharge)}}</b></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                        <h5 class="m-0 text-dark">باسکول : <b>{{number_format($safi->weighbridge)}}</b></h5>
                    </div><!-- /.col -->

                    <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                        <h5 class="m-0 text-dark">دستی : <b>{{number_format($safi->handy)}}</b></h5>
                    </div>

                    <div class="col-sm-4" style="border: 1px solid lightgray;padding: 10px">
                        <h5 class="m-0 text-dark">
                            مبلغ الباقی : <b>
                                {{number_format($total_products_price - (
                                    $safi->do_price + $safi->hire + $safi->discharge + $safi->weighbridge + $safi->handy
                                ))}}
                            </b></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12" style="border: 1px solid lightgray;padding: 10px">
                        <h5 class="m-0 text-dark"><b>آدرس :میانه میدان تره بار حجره ۱</b></h5>
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

<!-- jQuery -->
@include('dashboard.footer')
</body>
</html>
