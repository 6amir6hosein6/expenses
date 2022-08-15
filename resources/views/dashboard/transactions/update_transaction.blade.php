<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')

    <title>ویرایش تراکنش</title>

    <link href="{{asset('js/bootstrap-select.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/bootstrap-select.min.js')}}" defer></script>
    <script src="{{asset('js/create-transaction.js')}}" defer></script>
    <script src="{{asset('js/separate-number.js')}}" defer></script>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('dashboard.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1 class="m-0 text-dark">ویرایش تراکنش</h1>
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
            <div class="container-fluid">
                <div class="row">
                    <form method="post" action="{{route('transactions.update',[$transaction->id])}}" enctype="multipart/form-data"
                          style="width: 100%">
                        @csrf
                        @method('PUT')
                        <div class="card-body">


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="title">عنوان پرداخت</label>
                                        <input type="text" name="title" class="form-control"
                                               id="title" value="{{$transaction->title}}" placeholder="مثال : ۳ عدد نان"  required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="date">تاریخ پرداخت</label>
                                        <input type="text" name="date" class="form-control"
                                               id="date"  value="{{$transaction->date}}" required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="importance">درجه اهمیت (۱ تا ۵)</label>
                                        <input type="number" max="5" min="1" name="importance" class="form-control"
                                               id="importance"  value="{{$transaction->importance}}" required>
                                    </div>
                                </div>

                            </div>

                            <hr style="opacity: 70%">

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="price">مبلغ(تومان)</label>
                                        <input type="number" class="form-control"
                                               id="price" name="price"  placeholder="مثال : 200000" value="{{$transaction->price}}" required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="for_what">دسته بندی</label>
                                        <select name="for_what" class="form-control"
                                                id="for_what">
                                            <option value="خوراک">خوراک</option>
                                            <option value="پوشاک">پوشاک</option>
                                            <option value="حمل و نقل">حمل و نقل</option>
                                            <option value="خانه">خانه</option>
                                            <option value="قبوض">قبوض</option>
                                            <option value="متفرقه">متفرقه</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="description">توضیحات</label>
                                        <input type="text" class="form-control"
                                               id="description" value="{{$transaction->description}}" name="description">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <center>
                                            <button type="submit" class="btn btn-primary">ذخیره</button>
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
