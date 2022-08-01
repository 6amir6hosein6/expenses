<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>ویرایش مشتری</title>
</head>
<style>
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

        <div class="grid-container">
            <div class="grid-item item1">
                <center>
                    @if($customer->photo)
                        <img id="preview" src="data:image/png;base64, {{$customer->photo}}" style="width: 50%;margin-top: 10%;max-width: 300px;max-height: 400px"/>
                    @else
                        <img id="preview" src="{{asset('img/no_person.png')}}" style="width: 50%;margin-top: 10%;max-width: 300px;max-height: 400px"/>
                    @endif
                </center>
            </div>
            <div class="grid-item item2">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <form method="post" action="{{route('customers.update',$customer->id)}}" enctype="multipart/form-data" style="width: 100%">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">نوع مشتری</label>
                                                <select class="form-control select2" name="kind" style="width: 100%;">
                                                    <option @if($customer->kind == "خریدار") selected="selected" @endif value="خریدار">خریدار</option>
                                                    <option @if($customer->kind == "کشاورز") selected="selected" @endif value="کشاورز">کشاورز</option>
                                                    <option @if($customer->kind == "صاحب بار") selected="selected" @endif value="صاحب بار">صاحب بار</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">نام</label>
                                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="نام مشتری" value="{{$customer->name}}">
                                            </div>

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">شماره تلفن</label>
                                                <input type="text" name="phone" class="form-control" id="exampleInputPassword1" placeholder="شماره تلفن" value="{{$customer->phone}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">آدرس</label>
                                                <input type="text" name="address" class="form-control" id="exampleInputPassword1" placeholder="آدرس" value="{{$customer->address}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">بدهی(تومان)</label>
                                                <input type="number" name="debt" class="form-control" id="exampleInputPassword1" placeholder="بدهی" value="{{abs($customer->debt)}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1"> نوع بدهی</label>
                                                <select class="form-control" name="debt_kind" style="width: 100%;">
                                                    <option @if($customer->debt == 0) selected="selected" @endif value="0">بی حساب</option>
                                                    <option @if($customer->debt < 0) selected="selected" @endif value="1">بدهکار</option>
                                                    <option @if($customer->debt > 0) selected="selected" @endif value="-1">بستان کار</option>
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
                                                    <button type="submit" class="btn btn-primary">ویرایش کردن مشتری</button>
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
