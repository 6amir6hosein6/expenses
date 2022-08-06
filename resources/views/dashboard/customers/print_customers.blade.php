<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>چاپ لیست مشتریان</title>
</head>
<style>
    .table th {
        vertical-align: middle !important;
        text-align: center;
    }
</style>
<title>لیست  مشتریان</title>
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
                    <div class="col-sm-3" style="text-align: center;">
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
                        <h5 class="m-0 text-dark">لیست مشتریان <b>{{$title}}</b></h5>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <br>

            <div class="container-fluid " style="overflow-x:auto;">
                @if(isset($keyword))
                    <h5>نتیجه جست و جو برای : {{$keyword}}</h5>
                @endif
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th scope="col"> کد مشتری</th>
                        <th scope="col"> نام مشتری</th>
                        <th scope="col">نوع مشتری</th>
                        <th scope="col">تلفن</th>
                        <th scope="col">آدرس</th>
                        <th scope="col">مبلغ بدهی</th>
                        <th scope="col">نوع بدهی</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <th>
                                <center>{{$customer->id}}</center>
                            </th>
                            <th>{{$customer->name}}</th>
                            <th scope="col">{{$customer->kind}}</th>
                            <th scope="col">{{$customer->phone}}</th>
                            <th scope="col">{{$customer->address}}</th>
                            <th scope="col">{{abs($customer->debt)}}</th>
                            <th scope="col">
                                @if($customer->debt == 0)
                                    بی حساب
                                @elseif($customer->debt < 1)
                                    بستانکار
                                @else
                                    بدهکار
                                @endif
                            </th>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
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
