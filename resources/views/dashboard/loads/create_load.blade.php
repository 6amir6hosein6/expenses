<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>بار جدید</title>
    <!-- Bootstrap CSS -->
    <!-- Hierarchy Select CSS -->

    <link href="{{asset('js/bootstrap-select.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/bootstrap-select.min.js')}}" defer></script>
    <script>
        function setParam() {
            let d = document.getElementById("select-customer").value
            if (d !== "0") {
                const myArray = d.split("|");
                let name = myArray[0];
                let id = myArray[1].replace(/\s/g, '');

                document.getElementById("owner_name").value = name;
                document.getElementById("owner_id").value = id;
            } else {
                document.getElementById("owner_name").value = null;
                document.getElementById("owner_id").value = null;
            }
        }
    </script>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('dashboard.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">اضافه کردن بار جدید</h1>
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
                    <form method="post" action="{{route('loads.store')}}" enctype="multipart/form-data"
                          style="width: 100%">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">صاحب بار</label>
                                        <input type="text" name="owner_name" class="form-control"
                                               id="owner_name" readonly required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="owner_id">بارکد</label>
                                        <input type="text" name="owner_id" class="form-control"
                                               id="owner_id" readonly required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="select-customer"> لیست مشتری<a href="{{route('customers.create')}}"
                                                                                   style="font-size: 12px"> (افزودن
                                                مشتری) </a></label>
                                        <select class="selectpicker form-control" data-live-search="true"
                                                id="select-customer" onchange="setParam()">
                                            <option value="0" selected>انتخاب کنید</option>
                                            @foreach($customers as $customer)
                                                <option data-tokens="{{$customer->id}}"
                                                        value="{{$customer->name . '  |  ' . $customer->id}}">
                                                    {{$customer->name . '  |  ' . $customer->id}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">تاریخ رسید</label>
                                        <input type="text" name="date" class="form-control" id="exampleInputPassword1"
                                               value="{{$date}}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">نوع ماشین</label>
                                        <input type="text" name="machine_kind" class="form-control"
                                               id="exampleInputPassword1">
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">نام راننده</label>
                                        <input type="text" name="driver" class="form-control"
                                               id="exampleInputPassword1">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">شرح بار</label>
                                        <input type="text" name="description" class="form-control"
                                               id="exampleInputPassword1" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center>
                                            <button type="submit" class="btn btn-primary">اضافه کردن بار</button>
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
</div>

<!-- ./wrapper -->
<script>
    document.getElementById("owner_name").value = null;
    document.getElementById("owner_id").value = null;

</script>
@include('dashboard.footer')


</body>
</html>
