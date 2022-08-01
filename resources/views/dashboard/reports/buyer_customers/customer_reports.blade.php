<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>گزارش خرید مشتری</title>
    <link href="{{asset('js/bootstrap-select.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/bootstrap-select.min.js')}}" defer></script>
    <script src="{{asset('js/separate-number.js')}}" defer></script>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('dashboard.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <h1 class="m-0 text-dark">گزارش خرید مشتری </h1>
                        <br>
                        <h5 class="m-0 text-dark"> خرید {{$customer_name}} ، از تاریخ {{$since}} ، تا تاریخ
                            {{$until}}</h5>
                        <br>
                        <form method="POST" action="{{route('reports.get-buyer-customer-reports',[1])}}">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{$customer_id}}">
                            <input type="hidden" name="customer_name" value="{{$customer_name}}">
                            <input type="hidden" name="since" value="{{$since}}">
                            <input type="hidden" name="until" value="{{$until}}">
                            <button style="width: 100px" type="submit" class="btn btn-success"><i
                                    class="fa fa-print "></i></button>
                        </form>
                    </div><!-- /.col -->

                    <div class="col-sm-1">
                        @if($customer_image)
                            <img src="data:image/png;base64, {{$customer_image}}"
                                 style="max-width:100px;max-height: 150px">
                        @else
                            <img src="{{asset('img/no_person.png')}}" style="width: 100px;position: absolute">
                        @endif

                    </div><!-- /.col -->

                </div><!-- /.row -->

            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>کالا ها :</h5>
                        <table class="table" id="products_table" style="width: 100%">
                            <thead>
                            <tr>
                                <th scope="col">نام کالا</th>
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
                <hr>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <h5>تراکنش ها :</h5>
                        <table class="table" id="products_table" style="width: 100%">
                            <thead>
                            <tr>
                                <th scope="col">کد تراکنش</th>
                                <th scope="col">تاریخ</th>
                                <th scope="col">نام مشتری</th>
                                <th scope="col">مبلغ</th>
                                <th scope="col">نوع تراکنش</th>
                            </tr>
                            </thead>
                            <tbody id="products_tbody">
                            @foreach($transactions as $transaction)
                                <tr>
                                    <th>{{$transaction->id}}</th>
                                    <th>{{$transaction->date}}</th>
                                    <th>{{$transaction->customer_name}}</th>
                                    <th>{{$transaction->price}}</th>
                                    @if($transaction->type == 'دریافت وجه از مشتری')
                                        <th scope="col" style="color: green">{{$transaction->type}}</th>
                                    @else
                                        <th scope="col" style="color: red">{{$transaction->type}}</th>
                                @endif
                                <tr>
                            @endforeach
                            <tr>
                            </tbody>
                        </table>
                    </div>

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
