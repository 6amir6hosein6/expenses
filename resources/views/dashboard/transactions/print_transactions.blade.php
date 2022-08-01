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
                    <div class="col-sm-3" style="text-align: center;">
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
                    </div><!-- /.col -->

                </div>
                <br>
                <div class="row">
                    <div class="col-sm-9">
                        <h1 class="m-0 text-dark">لیست تراکنش ها
                            {{$title}}

                        </h1>
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
                        <th scope="col"> کد تراکنش</th>
                        <th scope="col"> تاریخ تراکنش</th>
                        <th scope="col"> نام مشتری</th>
                        <th scope="col">مبلغ تراکنش</th>
                        <th scope="col">نوع تراکنش</th>
                        <th scope="col">توضیحات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <th>{{$transaction->id}}</th>
                            <th>{{$transaction->date}}</th>
                            <th scope="col">{{$transaction->customer_name}}</th>
                            <th scope="col">{{$transaction->price}}</th>

                            @if($transaction->type == 'دریافت وجه از مشتری')
                                <th scope="col" style="color: green">{{$transaction->type}}</th>
                            @else
                                <th scope="col" style="color: red">{{$transaction->type}}</th>
                            @endif

                            <th scope="col">{{$transaction->description}}</th>

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
