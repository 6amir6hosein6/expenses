<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>لیست مشتریان</title>
</head>
<style>
    .table th {
        vertical-align: middle !important;
    }
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('dashboard.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-9">
                        <h1 class="m-0 text-dark">لیست بار ها</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-3">
                        <form action="{{route('loads.search')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control"
                                               placeholder="نام صاحب بار">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            @if (session('status'))
                <div class="alert alert-success">
                    <center>
                        <li class="breadcrumb-item">{{ session('status') }}</li>
                    </center>
                </div>
            @endif
            <div class="container-fluid " style="overflow-x:auto;">
                @if(isset($keyword))
                    <h5>نتیجه جست و جو برای : {{$keyword}}</h5>
                @endif
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"> کد بار</th>
                        <th scope="col"> تارخ رسید</th>
                        <th scope="col">نام صاحب بار</th>
                        <th scope="col">نوع ماشین</th>
                        <th scope="col">راننده</th>
                        <th scope="col">شرح بار</th>
                        <th scope="col">حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loads as $load)
                        <tr>
                            <th>
                                <center>{{$load->id}}</center>
                            </th>
                            <th>{{$load->date}}</th>
                            <th scope="col">{{$load->owner_name}}</th>
                            <th scope="col">{{$load->machine_kind}}</th>
                            <th scope="col">{{$load->driver}}</th>
                            <th scope="col">{{$load->description}}</th>
                            <th scope="col">
                                <form method="post"
                                      action="{{route('loads.destroy',['load'=>$load->id])}}"
                                      onSubmit="return confirm('آیا مطمعا هستید؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        style="font-size: 30px;color: red;border: none;background-color: inherit"
                                        type="submit"><i class="fa fa-trash "></i></button>
                                </form>
                            </th>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('dashboard.footer')
</body>
</html>
