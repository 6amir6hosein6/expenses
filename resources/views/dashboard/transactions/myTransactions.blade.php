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
                        <h1 class="m-0 text-dark">لیست تراکنش ها من</h1>
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
                        <th scope="col">کد</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">فی</th>
                        <th scope="col">واحد</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">مبلغ تراکنش</th>
                        <th scope="col">درجه اهمیت</th>
                        <th scope="col">دسته بندی</th>
                        <th scope="col">زیر دسته بندی</th>
                        <th scope="col">توضیحات</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <th scope="col">{{$transaction->id}}</th>
                            <th scope="col">{{$transaction->title}}</th>
                            <th scope="col">{{$transaction->fee}}</th>
                            <th scope="col">{{$transaction->fee_name}}</th>
                            <th scope="col">{{$transaction->date}}</th>
                            <th scope="col">{{$transaction->price}}</th>
                            <th scope="col">{{$transaction->importance}}</th>
                            <th scope="col">{{$transaction->for_what}}</th>
                            <th scope="col">{{$transaction->for_what_sub}}</th>
                            <th scope="col">{{$transaction->description}}</th>
                            <th scope="col">
                                <a style="font-size: 30px;"
                                   href="{{route('transactions.edit',[$transaction->id])}}"><i
                                        class="fa fa-edit"></i></a>
                            </th>
                            <th>
                                <form method="post"
                                      action="{{route('transactions.destroy',[$transaction->id])}}"
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
@include('dashboard.footer')
</body>
</html>
