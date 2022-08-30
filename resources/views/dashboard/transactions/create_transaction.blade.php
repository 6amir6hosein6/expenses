<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')

    <title>ثبت تراکنش جدید</title>

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
                        <h1 class="m-0 text-dark">ثبت تراکنش جدید</h1>
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
                    <form method="post" action="{{route('transactions.store')}}" enctype="multipart/form-data"
                          style="width: 100%">
                        @csrf
                        <div class="card-body">


                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="title">عنوان پرداخت</label>
                                        <input type="text" name="title" class="form-control"
                                               id="title" placeholder="مثال : نان"  required>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="fee">فی</label>
                                        <input type="number" name="fee" class="form-control"
                                               id="fee" placeholder="مثال : ۳ ">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="fee_name">نام واحد</label>
                                        <input type="text" name="fee_name" class="form-control"
                                               id="fee_name" placeholder="مثال : عدد">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="date">تاریخ پرداخت</label>
                                        <input type="text" name="date" class="form-control"
                                               id="date" value="{{$date}}" required>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="importance">درجه اهمیت (۱ تا ۵)</label>
                                        <input type="number" max="5" min="1" name="importance" class="form-control"
                                               id="importance" value="1" required>
                                    </div>
                                </div>

                            </div>

                            <hr style="opacity: 70%">

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="price">مبلغ(تومان)</label>
                                        <input type="number" class="form-control"
                                               id="price" name="price" placeholder="مثال : 200000" value="0" required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="for_what">دسته بندی</label>
                                        <select name="for_what" class="form-control"
                                                id="for_what" onchange="change_sub_cat()">
                                            <option selected disabled hidden>انتخاب کنید</option>
                                            <option value="خانه">خانه</option>
                                            <option value="قبوض">قبوض</option>
                                            <option value="خوراک">خوراک</option>
                                            <option value="ماشین">ماشین</option>
                                            <option value="حمل و نقل">حمل و نقل</option>
                                            <option value="مصرفی">مصرفی</option>
                                            <option value="شخصی">شخصی</option>
                                            <option value="تفریح و ورزش">تفریح و ورزش</option>
                                            <option value="مسافرت">مسافرت</option>
                                            <option value="مالی">مالی</option>
                                            <option value="متفرقه">متفرقه</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="for_what_sub">زیر دسته بندی</label>
                                        <select name="for_what_sub" class="form-control sub-cat-select"
                                                id="for_what_sub">
                                            <option selected disabled hidden>انتخاب کنید</option>
                                            <option disabled is="select-sub-first">زیر دسته بندی انتخاب کنید</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="description">توضیحات</label>
                                        <input type="text" class="form-control"
                                               id="description" name="description">
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
<script>
    function change_sub_cat(){
        let select = document.getElementById('for_what');
        let value = select.options[select.selectedIndex].value;

        let sub_select = document.getElementById('for_what_sub');
        removeAllChild(sub_select);

        if(value === "خانه"){
            ["اجاره","شارژ ساختمان","وسایل منزل"].forEach(addOption);
        }else if(value === "قبوض"){
            ["آب","برق","گاز","تلفن","موبایل","اینترنت"].forEach(addOption);
        }else if(value === "خوراک"){
            ["پروتئین","میوه","سبزیجات","خواروبار","خشکبار","رستوران و فست فود","کافی شاپ"].forEach(addOption);
        }else if(value === "ماشین"){
            ["بنزین","سرویس","کارواش","لوازم","تعمیرات","بیمه","عوارض" , "سایر"].forEach(addOption);
        }else if(value === "حمل و نقل"){
            ["تاکسی","هواپیما","قطار","اتوبوس","BRT"].forEach(addOption);
        }else if(value === "مصرفی"){
            ["دارو","لوازم آرایشی","لباس و کفش","لوازم برقی","ابزار و ‌وسیله"].forEach(addOption);
        }else if(value === "شخصی"){
            ["آرایشگاه","خشکشویی","کلاس آموزشی","پزشکی","هدیه","کمک به خیریه","پس انداز"].forEach(addOption);
        }else if(value === "تفریح و ورزش"){
            ["سینما","تئاتر","ورزش","تفریح","غیره"].forEach(addOption);
        }else if(value === "مسافرت"){
            ["اقامت و هتل","پاسپورت و ویزا","خوراک","تفریحات سفر"].forEach(addOption);
        }else if(value === "مالی"){
            ["اقساط","بدهی"].forEach(addOption);
        }else{
            ["متفرقه"].forEach(addOption);
        }

    }
    function addOption(item, index){
        let sub_select = document.getElementById('for_what_sub');
        let opt = document.createElement('option');
        opt.value = item;
        opt.innerHTML = item;
        sub_select.appendChild(opt);
    }

    function removeAllChild(selectBox){
        while (selectBox.options.length > 0) {
            selectBox.remove(0);
        }
    }
</script>
</body>
</html>
