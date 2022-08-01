<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>کالای جدید</title>
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
                        <h1 class="m-0 text-dark">اضافه کردن کالا</h1>
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
                    <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data" style="width: 100%">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نام</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="مثال : سیب زمینی" required>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center>
                                            <button type="submit" class="btn btn-primary">اضافه کردن کالا</button>
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
@include('dashboard.footer')

</body>
</html>
