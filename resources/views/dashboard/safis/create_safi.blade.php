<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>صدور صافی</title>
    <link href="{{asset('js/bootstrap-select.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/bootstrap-select.min.js')}}" defer></script>
    <script src="{{asset('js/create-safi.js')}}" defer></script>
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
                        <h1 class="m-0 text-dark">صدور صافی</h1>
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
                    <form method="post" action="{{route('safis.store')}}" enctype="multipart/form-data"
                          style="width: 100%">
                        @csrf
                        <div class="card-body">


                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="date">تاریخ فاکتور</label>
                                        <input type="text" name="date" class="form-control"
                                               id="date" value="{{$date}}" required>
                                    </div>
                                </div>

                            </div>

                            <hr style="opacity: 70%">

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="load_owner_name">نام صاحب بار</label>
                                        <input type="text" name="load_owner_name" class="form-control"
                                               id="load_owner_name" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="load_id">بارکد</label>
                                        <input type="text" name="load_id" class="form-control"
                                               id="load_id" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="load_driver">راننده</label>
                                        <input type="text" name="load_driver" class="form-control"
                                               id="load_driver" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="select-loads"> لیست بار های رسیده شده</label>
                                        <select class="selectpicker form-control" data-live-search="true"
                                                id="select-loads" onchange="setParamLoad()">
                                            <option value="0" selected>انتخاب کنید</option>
                                            @foreach($loads as $load)
                                                <option data-tokens="{{$load->id}}"
                                                        value="{{$load->id . '  |  ' . $load->owner_name . '  |  ' . $load->driver}}">
                                                    {{$load->id . '  |  ' . $load->owner_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr style="opacity: 70%">

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="product_name">کالا</label>
                                        <input type="text" class="form-control"
                                               id="product_name" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="product_id">بارکد</label>
                                        <input type="text" class="form-control"
                                               id="product_id" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="select-products"> لیست کالا ها</label>
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

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label style="visibility: hidden">جستجو</label>
                                        <button type="button" class="btn btn-primary form-control" id="searchBtn"
                                                onclick="getProduct('<?php echo asset('safi/get-products')?>')">جستجو
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
                                        <label for="total_count">تعداد کل محصولات</label>
                                        <input type="text" class="form-control"
                                               id="total_count" value="0" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="total_price">قیمت کل محصولات(تومان)</label>
                                        <input type="text" class="form-control"
                                               id="total_price" value="0" readonly required>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <hr style="opacity: 70%">
                            <br>
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="do_price">حق العمل (تومان)</label>
                                        <input type="text" class="form-control" onkeyup="calculateExistPrice()"
                                               id="do_price" name="do_price" value="0">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="hire">کرایه (تومان)</label>
                                        <input type="text" class="form-control" onkeyup="calculateExistPrice()"
                                               id="hire" name="hire" value="0">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="discharge">تخلیه (تومان)</label>
                                        <input type="text" class="form-control" onkeyup="calculateExistPrice()"
                                               id="discharge" name="discharge" value="0">
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="weighbridge">باسکول (تومان)</label>
                                        <input type="text" class="form-control" onkeyup="calculateExistPrice()"
                                               id="weighbridge" name="weighbridge" value="0">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="handy">دستی (تومان)</label>
                                        <input type="text" class="form-control" onkeyup="calculateExistPrice()"
                                               id="handy" name="handy" value="0">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exist_price">مبلغ الباقی (تومان)</label>
                                        <input type="text" class="form-control"
                                               id="exist_price" value="0" readonly>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center>
                                            <button type="submit" class="btn btn-primary">ثبت فاکتور صافی</button>
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
    document.getElementById('select-loads').selectedIndex = "0";
    document.getElementById('select-products').selectedIndex = "0";

    document.getElementById("load_id").value = null;
    document.getElementById("load_owner_name").value = null;
    document.getElementById("load_driver").value = null;


    document.getElementById("product_id").value = null;
    document.getElementById("product_name").value = null;
    document.getElementById("products_data").value = "[]";

    document.getElementById("exist_price").value = 0;
    document.getElementById("hire").value = 0;
    document.getElementById("discharge").value = 0;
    document.getElementById("weighbridge").value = 0;
    document.getElementById("handy").value = 0;
    document.getElementById("do_price").value = 0;

    document.getElementById("total_weight").value = 0;
    document.getElementById("total_price").value = 0;
    document.getElementById("total_count").value = 0;

</script>
@include('dashboard.footer')

</body>
</html>
