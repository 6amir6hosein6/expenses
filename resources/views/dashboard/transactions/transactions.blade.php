<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>لیست تراکنش ها</title>
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
                    <div class="col-md-6">
                        <h1 class="m-0 text-dark">لیست تراکنش ها
                            @if(isset($categorized))ی {{$categorized}}
                            @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <form action="{{route('transactions.search')}}" method="post">
                            @csrf
                            <input type="hidden" id="type" name="type" value="0">
                            <div class="row">
                                <div role="group">
                                    <a class="btn btn-danger" onclick="changeType(1)" id="select-type1"
                                       href="#">پرداخت وجه</a>
                                    <a class="btn btn-success" onclick="changeType(2)" id="select-type2" href="#">دریافت
                                        وجه</a>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control"
                                               placeholder="نام مشتری یا کد تراکنش ..."
                                               @isset($keyword)
                                                value="{{$keyword}}"
                                               @endisset
                                        >
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    @if(isset($keyword))
                                        <a class="btn btn-success"
                                           href="{{route('transactions.print',[$category_type,$keyword])}}">
                                            <i class="fa fa-print "></i>
                                        </a>
                                    @else
                                        <a class="btn btn-success"
                                           href="{{route('transactions.print',[$category_type,null])}}">
                                            <i class="fa fa-print "></i>
                                        </a>
                                    @endif

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
                        <th scope="col"> کد تراکنش</th>
                        <th scope="col"> تاریخ تراکنش</th>
                        <th scope="col"> نام مشتری</th>
                        <th scope="col">مبلغ تراکنش</th>
                        <th scope="col">نوع تراکنش</th>
                        <th scope="col">توضیحات</th>
                        <th scope="col">حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <th>{{$transaction->id}}</th>
                            <th>{{$transaction->date}}</th>
                            <th scope="col">{{$transaction->customer_name}}</th>
                            <th scope="col">{{$transaction->price}}</th>

                            @if($transaction->type == 'دریافت وجه از مشتری')
                                <th scope="col" style="color: green">{{$transaction->type}}</th>
                            @else
                                <th scope="col" style="color: red">{{$transaction->type}}</th>
                            @endif

                            <th scope="col">{{$transaction->description}}</th>
                            <th scope="col">

                                <form method="post"
                                      action="{{route('transactions.destroy',['transaction_id'=>$transaction->id])}}"
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
<script>
    document.getElementById('type').value = 0;

    function changeType(type) {
        let last_type = document.getElementById('type').value;
        document.getElementById('select-type1').style = "filter: brightness(100%);"
        document.getElementById('select-type2').style = "filter: brightness(100%);"
        if (type != last_type) {
            document.getElementById('type').value = type;
            document.getElementById('select-type' + type).style = "filter: brightness(60%);"
        } else {
            document.getElementById('type').value = 0;
        }
    }
</script>
@include('dashboard.footer')
</body>
</html>
