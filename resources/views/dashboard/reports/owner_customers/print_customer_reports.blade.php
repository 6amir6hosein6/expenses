<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>گزارش فروش صاحب بار ها و کشاورزان</title>
</head>
<style>
    .table th {
        vertical-align: middle !important;
        text-align: center;
    }
</style>
<title>لیست مشتریان</title>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-right: 0; !important;background: white !important;">
        <div class="content-header">
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3">
                        <h6>بسمه تعالی</h6>
                    </div>
                    <div class="col-sm-6">
                        <h2 class="m-0 text-dark">بار فروشی سیفعلی سیرانی و پسران</h2>
                    </div><!-- /.col -->
                    <div class="col-sm-3" style="">
                        <h6>
                            تلفن حجره : 52232129 - 041
                        </h6>
                        <h6>
                            سیفعلی سیرانی : 09141248299
                        </h6>
                        <h6>
                            سعید سیرانی : 09149241945
                        </h6>
                        <h6>
                            فرهاد سیرانی : 09148290018
                        </h6>
                        <h6>
                            فرزین سیرانی : 09145020488
                        </h6>
                    </div><!-- /.col -->

                </div>
                <br>
                <div class="row">
                    <div class="col-sm-9">
                        <h3 class="m-0 text-dark">گزارش فروش صاحب بار ها و کشاورزان</h3>
                        <br>
                        <h5 class="m-0 text-dark"> فروش {{$customer_name}} ، از تاریخ {{$since}} ، تا تاریخ
                            {{$until}}</h5>
                        <br>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <br>

            <div class="container-fluid" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>کالا ها :</h5>
                        <table class="table" id="products_table" style="width: 100%">
                            <thead>
                            <tr>
                                <th scope="col">نام کالا</th>
                                <th scope="col">نام خریدار</th>
                                <th scope="col">تعداد</th>
                                <th scope="col">وزن</th>
                                <th scope="col">فی(تومان)</th>
                                <th scope="col">کل(تومان)</th>
                                <th scope="col">تاریخ</th>
                            </tr>
                            </thead>
                            <tbody id="products_tbody">
                            @foreach($factors_products as $product)
                                <tr>
                                    <th>{{$product->product_name}}</th>
                                    <th>{{$product->buyer}}</th>
                                    <th>{{$product->count}}</th>
                                    <th>{{$product->weight}}</th>
                                    <th>{{$product->fee}}</th>
                                    <th>{{$product->fee * $product->count * $product->weight}}</th>
                                    <th>{{$product->date}}</th>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
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
