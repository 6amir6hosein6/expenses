<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>مشتری جدید</title>
</head><style>
    .item1 { grid-area: p1; }
    .item2 { grid-area: p2; }

    .grid-container {
        display: grid;
        grid-template-areas:
                'p2 p2 p2 p2 p2 p2 p1 p1 p1';
        gap: 10px;
        padding: 10px;
    }

    .grid-item {
        padding: 20px;
    }

    .grid-container > div {
    }
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
                        <h1 class="m-0 text-dark">اضافه کردن مشتری</h1>
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
        </section>
        <div class="grid-container">

            <div class="grid-item item1">
                <center>
                    <img id="preview" src="{{asset('img/no_person.png')}}" style="width: 50%;margin-top: 10%;max-width: 300px;max-height: 400px"/>
                </center>
            </div>
            <div class="grid-item item2">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <form method="post" action="{{route('customers.store')}}" enctype="multipart/form-data" style="width: 100%">
                                @csrf
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">نوع مشتری</label>
                                                <select class="form-control select2" name="kind" style="width: 100%;">
                                                    <option selected="selected" value="خریدار">خریدار</option>
                                                    <option value="کشاورز">کشاورز</option>
                                                    <option value="صاحب بار">صاحب بار</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">نام</label>
                                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="مثال : سعید سیرانی">
                                            </div>

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">شماره تلفن</label>
                                                <input type="text" name="phone" class="form-control" id="exampleInputPassword1" placeholder="مثال : ۰۹۱۲۵۸۵۲۲۳۷">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">آدرس</label>
                                                <input type="text" name="address" class="form-control" id="exampleInputPassword1" placeholder=" مثال : میانه">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">بدهی(تومان)</label>
                                                <input type="number" name="debt" class="form-control" id="exampleInputPassword1" placeholder="مثال : ۱۰۰۰۰۰۰" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">بدهی نوع بدهی</label>
                                                <select class="form-control" name="debt_kind" style="width: 100%;">
                                                    <option selected="selected" value="0">بی حساب</option>
                                                    <option value="1">بدهکار</option>
                                                    <option value="-1">بستان کار</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="image1">عکس مشتری</label>
                                                <input type="file" accept="image/*" name="photo" class="form-control" id="image1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <center>
                                                    <button type="submit" class="btn btn-primary">اضافه کردن مشتری</button>
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
            </div>
        </div>


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
<script>
    const chooseFile = document.getElementById("image1");
    const imgPreview = document.getElementById("preview");

    chooseFile.addEventListener("change", function () {
        getImgData();
    });

    function getImgData() {
        const files = chooseFile.files[0];
        if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);

            fileReader.addEventListener("load", function () {
                imgPreview.src = this.result;
            });
        }
    }
</script>
@include('dashboard.footer')

</body>
</html>
