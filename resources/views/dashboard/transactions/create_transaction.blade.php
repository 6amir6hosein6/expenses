<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')

    @if($type == "پرداخت وجه به مشتری")
        <title>پرداخت وجه به مشتری</title>
    @else
        <title>دریافت وجه از مشتری</title>
    @endif

    <link href="{{asset('js/bootstrap-select.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/bootstrap-select.min.js')}}" defer></script>
    <script src="{{asset('js/create-transaction.js')}}" defer></script>
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
                    <div class="col-sm-9">
                        @if($type == "پرداخت وجه به مشتری")
                            <h1 class="m-0 text-dark">پرداخت وجه به مشتری</h1>
                        @else
                            <h1 class="m-0 text-dark">دریافت وجه از مشتری</h1>
                        @endif

                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-error">
                        <span class="breadcrumb-item">{{$error}}</span>
                    </div>
                @endforeach

            @endif
            <div class="container-fluid">
                <div class="row">
                    <form method="post" action="{{route('transactions.store',['type'=>$type])}}" enctype="multipart/form-data"
                          style="width: 100%">
                        @csrf
                        <div class="card-body">


                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="date">تاریخ پرداخت</label>
                                        <input type="text" name="date" class="form-control"
                                               id="date" value="{{$date}}" required>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="customer_name">نام مشتری</label>
                                        <input type="text" name="customer_name" class="form-control"
                                               id="customer_name" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="customer_id">بارکد</label>
                                        <input type="text" name="customer_id" class="form-control"
                                               id="customer_id" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="debt">مانده حساب (تومان)</label>
                                        <input type="text" class="form-control"
                                               id="debt" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="select-customer"> لیست مشتری<a href="{{route('customers.create')}}"
                                                                                   style="font-size: 12px"> (افزودن
                                                مشتری) </a></label>
                                        <select class="selectpicker form-control" data-live-search="true"
                                                id="select-customer" onchange="setParam()">
                                            <option value="0" selected>انتخاب کنید</option>
                                            @foreach($customers as $customer)
                                                <option data-tokens="{{$customer->id}}"
                                                        value="{{$customer->name . '  |  ' . $customer->id . '  |  ' . $customer->debt}}">
                                                    {{$customer->name . '  |  ' . $customer->id}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr style="opacity: 70%">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="price">مبلغ</label>
                                        <input type="number" class="form-control"
                                               id="price" name="price" value="0" required>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="description">توضیحات</label>
                                        <input type="text" class="form-control"
                                               id="description" name="description">
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center>
                                            <button type="submit" class="btn btn-primary">ذخیره</button>
                                        </center>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                    </form>
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
<script>
    document.getElementById('select-customer').selectedIndex = "0";

    document.getElementById("customer_name").value = null;
    document.getElementById("customer_id").value = null;
    document.getElementById("debt").value = null;

    document.getElementById("price").value = 0;
    document.getElementById("description").value = null;

</script>
@include('dashboard.footer')

</body>
</html>
