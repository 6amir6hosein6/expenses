<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>ویرایش فاکتور</title>

    <link href="{{asset('js/bootstrap-select.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/bootstrap-select.min.js')}}" defer></script>

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
                        <h1 class="m-0 text-dark">ویرایش فاکتور</h1>
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
                    <form method="post" action="{{route('factors.update',$factor->id)}}" enctype="multipart/form-data"
                          style="width: 100%">
                        @csrf
                        @method('PUT')
                        <div class="card-body">


                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="date">تاریخ فاکتور</label>
                                        <input type="text" name="date" class="form-control"
                                               id="date" value="{{$factor->date}}" required>
                                    </div>
                                </div>
                                <div class="col-sm-7">

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="date" style="visibility: hidden">چاپ فاکتور</label>
                                        <a class="btn btn-success form-control" href="{{route('factor.print',$factor->id)}}">
                                            <i class="fa fa-print "></i>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="customer_name">نام مشتری</label>
                                        <input type="text" name="customer_name" class="form-control"
                                               id="customer_name" value="{{$factor->customer_name}}" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="customer_id">بارکد</label>
                                        <input type="text" name="customer_id" class="form-control"
                                               id="customer_id" value="{{$factor->customer_id}}" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="debt">مانده حساب (تومان)</label>
                                        <input type="text" class="form-control"
                                               id="debt" value="{{$factor->last_debt}}" name="last_debt" readonly
                                               required>
                                    </div>
                                </div>
                            </div>

                            <hr style="opacity: 70%">

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="load_description">شرح بار</label>
                                        <input type="text" name="load_description" class="form-control"
                                               id="load_description" value="{{$factor->load_description}}" readonly
                                               required>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="load_id">بارکد</label>
                                        <input type="text" name="load_id" class="form-control"
                                               id="load_id" value="{{$factor->load_id}}" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="select-loads"> لیست بار<a href="{{route('loads.create')}}"
                                                                              style="font-size: 12px"> (افزودن بار) </a></label>
                                        <select class="selectpicker form-control" data-live-search="true"
                                                id="select-loads" onchange="setParamLoad()">
                                            <option value="0" selected>انتخاب کنید</option>
                                            @foreach($loads as $load)
                                                <option data-tokens="{{$load->id}}"
                                                        value="{{$load->id . '  |  ' . $load->owner_name . '  -  ' . $load->description . '  -  ' . $load->date}}">
                                                    {{$load->id . '  |  ' . $load->owner_name . '  -  ' . $load->description . '  -  ' . $load->date}}
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
                                        <label for="product_name">کالا</label>
                                        <input type="text" class="form-control"
                                               id="product_name" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="product_id">بارکد</label>
                                        <input type="text" class="form-control"
                                               id="product_id" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="select-products"> لیست کالا ها<a href="{{route('products.create')}}"
                                                                                     style="font-size: 12px"> (افزودن
                                                کالا) </a></label>
                                        <select class="selectpicker form-control" data-live-search="true"
                                                id="select-products" onchange="setParamProducts()">
                                            <option value="0" selected>انتخاب کنید</option>
                                            @foreach($products as $product)
                                                <option data-tokens="{{$product->id}}"
                                                        value="{{$product->id . '  |  ' . $product->name}}">
                                                    {{$product->id . '  |  ' . $product->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="weight">وزن</label>
                                        <input type="text" class="form-control"
                                               id="weight" value="0" onkeyup="totalCalculate()">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="count">تعداد</label>
                                        <input type="text" class="form-control"
                                               id="count" value="0" onkeyup="totalCalculate()">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="fee">فی(تومان)</label>
                                        <input type="text" class="form-control"
                                               id="fee" value="0" onkeyup="totalCalculate()">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="total">کل(تومان)</label>
                                        <input type="text" class="form-control"
                                               id="total" value="0" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label style="visibility: hidden">افزودن کالا</label>
                                        <button type="button" class="btn btn-primary form-control"
                                                onclick="addProduct()">افزودن
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" value="[]" name="products_data" id="products_data">
                                    <table class="table" id="products_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">نام کالا</th>
                                            <th scope="col">وزن</th>
                                            <th scope="col">تعداد</th>
                                            <th scope="col">فی(تومان)</th>
                                            <th scope="col">کل(تومان)</th>
                                            <th scope="col">خذف</th>
                                        </tr>
                                        </thead>
                                        <tbody id="products_tbody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <hr style="opacity: 70%">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="total_weight">وزن کل محصولات</label>
                                        <input type="text" class="form-control"
                                               id="total_weight" value="0" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="total_price">قیمت کل محصولات (تومان)</label>
                                        <input type="text" class="form-control"
                                               id="total_price" value="0" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="worker_paid">هزینه کارگری</label>
                                        <input type="text" class="form-control" onkeyup="calculateWorkerPaid()"
                                               value="{{$factor->worker_paid}}" id="worker_paid" name="worker_paid" required>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="total_debt">قیمت کل فاکتور (تومان)</label>
                                        <input type="text" class="form-control"
                                               id="total_debt" value="0" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="paid">پرداختی(تومان)</label>
                                        <input type="text" class="form-control" onkeyup="calculatePaid()"
                                               id="paid" value="{{$factor->paid}}" name="paid" required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exist_price">باقی مانده</label>
                                        <input type="text" class="form-control"
                                               id="exist_price" value="0" readonly>
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center>
                                            <button type="submit" class="btn btn-primary">ویرایش فاکتور</button>
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
<script src="{{asset('js/separate-number.js')}}"></script>
<script>
    document.getElementById('select-products').selectedIndex = "0";

    document.getElementById("customer_name").value = "{{$factor->customer_name}}";
    document.getElementById("customer_id").value = {{$factor->customer_id}};
    document.getElementById("debt").value = addCommas({{$factor->last_debt}});

    document.getElementById("load_id").value = {{$factor->load_id}};
    document.getElementById("load_description").value = "{{$factor->load_description}}";


    document.getElementById("product_id").value = null;
    document.getElementById("product_name").value = null;


    document.getElementById("weight").value = 0;
    document.getElementById("count").value = 0;
    document.getElementById("fee").value = 0;
    document.getElementById("total").value = 0;

    document.getElementById("total_weight").value = 0;
    document.getElementById("total_price").value = 0;

    document.getElementById("paid").value = {{$factor->paid}};
    document.getElementById("total_debt").value = {{$factor->last_debt}};
    document.getElementById("exist_price").value = {{$factor->last_debt}};

    let total_debt = {{$factor->last_debt}};
    let products_data = JSON.parse(' {!! $factor_products !!} ');
    let products_json = JSON.stringify(products_data);
    document.getElementById("products_data").value = products_json;

</script>
<script src="{{asset('js/update-factor.js')}}"></script>

@include('dashboard.footer')

</body>
</html>
