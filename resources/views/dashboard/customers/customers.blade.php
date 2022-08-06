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
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            لیست مشتریان

                            @if(isset($categorized))
                                {{$categorized}}
                            @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <form action="{{route('customers.search')}}" method="post">
                            @csrf
                            <input type="hidden" id="type" name="type" value="0">
                            <div class="row">
                                <div role="group">
                                    <a class="btn btn-danger" onclick="changeType(1)" id="select-type1"
                                       href="#">بدهکار</a>
                                    <a class="btn btn-success" onclick="changeType(2)" id="select-type2" href="#">بستانکار</a>
                                    <a class="btn btn-info" onclick="changeType(3)" id="select-type3" href="#">بی
                                        حساب</a>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control"
                                               placeholder="نام مشتری">
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
                                           href="{{route('customers.print',[$category_type,$keyword])}}">
                                            <i class="fa fa-print "></i>
                                        </a>
                                    @else
                                        <a class="btn btn-success"
                                           href="{{route('customers.print',[$category_type,null])}}">
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
            @if (session('customer_delete'))
                <div class="alert alert-danger">
                    <center>
                        <li class="breadcrumb-item">{{ session('customer_delete') }}</li>
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
                        <th scope="col"> کد مشتری</th>
                        <th scope="col"> نام مشتری</th>
                        <th scope="col">نوع مشتری</th>
                        <th scope="col">تلفن</th>
                        <th scope="col">آدرس</th>
                        <th scope="col">عکس</th>
                        <th scope="col">مبلغ بدهی</th>
                        <th scope="col">نوع بدهی</th>
                        <th scope="col">تراکنش ها</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <th>
                                <center>{{$customer->id}}</center>
                            </th>
                            <th>{{$customer->name}}</th>
                            <th scope="col">{{$customer->kind}}</th>
                            <th scope="col">{{$customer->phone}}</th>
                            <th scope="col">{{$customer->address}}</th>
                            <th scope="col">
                                @if($customer->photo)
                                    <img src="{{$customer->photo}}"
                                         style="width: 100px;max-width: 100px">
                                @else
                                    عکس ندارد
                                @endif
                            </th>
                            <th scope="col">{{abs($customer->debt)}}</th>
                            <th scope="col">
                                @if($customer->debt == 0)
                                    بی حساب
                                @elseif($customer->debt < 1)
                                    بستانکار
                                @else
                                    بدهکار
                                @endif
                            </th>

                            <th scope="col">
                                <a style="font-size: 30px;"
                                   href="{{route('transactions.customer-transactions',['customer_id'=>$customer->id])}}"><i
                                        class="fa fa-list-alt "></i></a>
                            </th>

                            <th scope="col">
                                <a style="font-size: 30px;"
                                   href="{{route('customers.edit',['customer'=>$customer->id])}}"><i
                                        class="fa fa-edit"></i></a>
                            </th>
                            <th scope="col">

                                <form method="post"
                                      action="{{route('customers.destroy',['customer'=>$customer->id])}}"
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
<script>
    document.getElementById('type').value = 0;

    function changeType(type) {
        let last_type = document.getElementById('type').value;
        document.getElementById('select-type1').style = "filter: brightness(100%);"
        document.getElementById('select-type2').style = "filter: brightness(100%);"
        document.getElementById('select-type3').style = "filter: brightness(100%);"
        if (type != last_type) {
            console.log("a")
            document.getElementById('type').value = type;
            document.getElementById('select-type' + type).style = "filter: brightness(60%);"
        } else {
            console.log('b')
            document.getElementById('type').value = 0;
        }
    }
</script>
@include('dashboard.footer')
</body>
</html>
