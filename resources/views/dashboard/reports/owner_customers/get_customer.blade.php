<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>گزارش فروش صاحب بار ها و کشاورزان</title>
    <link href="{{asset('js/bootstrap-select.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/bootstrap-select.min.js')}}" defer></script>
    <script src="{{asset('js/customer_reports.js')}}" defer></script>
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
                        <h1 class="m-0 text-dark">گزارش فروش صاحب بار ها و کشاورزان</h1>
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
                    <form method="POST" action="{{route('reports.get-owner-customer-reports')}}" style="width: 100%">
                        @csrf
                        <div class="card-body">
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
                                        <label for="select-customer"> لیست کشاورزان و صاحب بار ها<a href="{{route('customers.create')}}"
                                                                                   style="font-size: 12px"> (افزودن
                                                مشتری) </a></label>
                                        <select class="selectpicker form-control" data-live-search="true"
                                                id="select-customer" onchange="setParamCustomer()">
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

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="since">از تاریخ</label>
                                        <input type="text" class="form-control"
                                               id="since" name="since" value="{{$date}}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="until">تا تاریخ</label>
                                        <input type="text" class="form-control"
                                               id="until" name="until" value="{{$date}}">
                                    </div>
                                </div>

                            </div>

                            <hr style="opacity: 70%">

                            <div class="row">
                                <div class="col-sm-9">

                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label style="visibility: hidden">جستجو</label>
                                        <button type="submit" class="btn btn-primary form-control" id="searchBtn">جستجو</button>
                                    </div>
                                </div>
                            </div>

                        </div>
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

</script>
@include('dashboard.footer')

</body>
</html>
