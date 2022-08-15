<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>ارسال پیام</title>
</head>
<style>
</style>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('dashboard.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">ارسال پیام</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            @if ($errors->any())
                <br>
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <span class="breadcrumb-item">{{$error}}</span>
                    @endforeach
                </div>
            @endif
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="post" action="{{route('messages.store')}}" enctype="multipart/form-data"
                          style="width: 100%">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>پیام خود را بنویسید</label>
                                        <textarea type="text" name="message" class="form-control" id="exampleInputEmail1"
                                                  placeholder="متن پیام" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center>
                                            <button type="submit" class="btn btn-primary">ارسال پیام</button>
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
@include('dashboard.footer')

</body>
</html>
