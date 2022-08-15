<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>ویرایش عضو</title>
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
                        <h1 class="m-0 text-dark">ویرایش عضو</h1>
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
                    <form method="post" action="{{route('members.update',$member->id)}}" enctype="multipart/form-data"
                          style="width: 100%">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نام</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                               placeholder="مثال : سعید سیرانی" value="{{$member->name}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">شماره تلفن</label>
                                        <input type="text" name="phone" class="form-control" id="exampleInputPassword1"
                                               placeholder="مثال : ۰۹۱۲۵۸۵۲۲۳۷" value="{{$member->phone}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">کدملی</label>
                                        <input type="text" name="national_id" class="form-control"
                                               id="exampleInputPassword1" placeholder="مثال : 0021236547" value="{{$member->national_id}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">عنوان</label>
                                        <input type="text" name="title" class="form-control"
                                               id="exampleInputPassword1" placeholder="مثال : مادر" value="{{$member->title}}">
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center>
                                            <button type="submit" class="btn btn-primary">,ویرایش</button>
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
