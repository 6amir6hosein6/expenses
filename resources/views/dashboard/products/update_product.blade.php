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
                        <h1 class="m-0 text-dark">ویرایش کردن کالا</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="post" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data" style="width: 100%">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نام</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="مثال : سیب زمینی" value="{{$product->name}}" required>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <center>
                                            <button type="submit" class="btn btn-primary">ویرایش کردن کالا</button>
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
