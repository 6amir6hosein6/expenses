<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>لیست فاکتور های صافی</title>
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
                    <div class="col-md-8">
                        <h1 class="m-0 text-dark">لیست فاکتورهای صافی</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-3">
                        <form action="{{route('safis.search')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control"
                                               placeholder="نام مشتری یا شماره فاکتور">
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
            @if (session('error'))
                <div class="alert alert-error">
                    <center>
                        <li class="breadcrumb-item">{{ session('error') }}</li>
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
                        <th scope="col"> کد فاکتور</th>
                        <th scope="col"> تاریخ فاکتور</th>
                        <th scope="col"> نام صاحب بار</th>
                        <th scope="col">جمع کل</th>
                        <th scope="col">چاپ</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($safis as $safi)
                        <tr>
                            <th>{{$safi->id}}</th>

                            <th>{{$safi->date}}</th>
                            <th scope="col">{{$safi->load_owner_name}}</th>

                            <th scope="col">{{$safi->total_price}}</th>

                            <th scope="col">
                                <a style="font-size: 30px;color: darkgreen"
                                   href="{{route('safi.print',$safi->id)}}"><i
                                        class="fa fa-print"></i></a>
                            </th>

                            <th scope="col">
                                <a style="font-size: 30px;"
                                   href="{{route('safis.edit',['safi'=>$safi->id])}}"><i
                                        class="fa fa-edit"></i></a>
                            </th>
                            <th scope="col">

                                <form method="post"
                                      action="{{route('safis.destroy',['safi'=>$safi->id])}}"
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
