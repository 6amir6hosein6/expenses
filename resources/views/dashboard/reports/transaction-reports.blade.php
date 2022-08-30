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
                    <div class="col-md-4">
                        <h1 class="m-0 text-dark">گزارش خرید های {{$title}}</h1>
                    </div><!-- /.col -->
                    <form class="col-md-7" action="{{route('reports.transaction_reports_weekly')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="for_what">دسته بندی</label>
                                    <select name="for_what" class="form-control"
                                            id="for_what" onchange="change_sub_cat()">
                                        <option value="همه" selected>همه</option>
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="for_what_sub">زیر دسته بندی</label>
                                    <select name="for_what_sub" class="form-control sub-cat-select"
                                            id="for_what_sub">
                                        <option selected disabled hidden>انتخاب کنید</option>
                                        <option disabled is="select-sub-first">زیر دسته بندی انتخاب کنید</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="for_what" style="visibility: hidden">دسته بندی</label>
                                    <input type="submit" class="btn btn-success" value="اعمال">
                                </div>
                            </div>
                        </div>
                    </form>
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
                <h5>دسته بندی : {{$for_what}}</h5>
                <h5>زیر دسته بندی : {{$for_what_sub}}</h5>
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">کد</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">توسط</th>
                        <th scope="col">فی</th>
                        <th scope="col">واحد</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">مبلغ تراکنش</th>
                        <th scope="col">درجه اهمیت</th>
                        <th scope="col">دسته بندی</th>
                        <th scope="col">زیر دسته بندی</th>
                        <th scope="col">توضیحات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total_price = 0 ?>
                    <?php $total_importance = 0 ?>
                    @foreach($transactions as $transaction)
                        <?php $total_price +=  $transaction->price?>
                        <?php $total_importance +=  $transaction->importance?>
                        <tr>
                            <th scope="col">{{$transaction->id}}</th>
                            <th scope="col">{{$transaction->title}}</th>
                            <th scope="col">{{$transaction->name}}</th>
                            <th scope="col">{{$transaction->fee}}</th>
                            <th scope="col">{{$transaction->fee_name}}</th>
                            <th scope="col">{{$transaction->date}}</th>
                            <th scope="col">{{$transaction->price}}</th>
                            <th scope="col">{{$transaction->importance}}</th>
                            <th scope="col">{{$transaction->for_what}}</th>
                            <th scope="col">{{$transaction->for_what_sub}}</th>
                            <th scope="col">{{$transaction->description}}</th>
                        </tr>
                    @endforeach

                    <tr>
                        <th scope="col"></th>
                        <th scope="col">کل</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">{{$total_price}}</th>
                        @if(sizeof($transactions) !=0)
                            <th scope="col">میانگین اهمیت : {{$total_importance / sizeof($transactions)}}</th>
                        @else
                            <th scope="col">میانگین اهمیت : {{0}}</th>
                        @endif
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>

                    </tbody>
                </table>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
@include('dashboard.footer')
<script>
    function change_sub_cat(){
        let select = document.getElementById('for_what');
        let value = select.options[select.selectedIndex].value;

        let sub_select = document.getElementById('for_what_sub');
        removeAllChild(sub_select);
        ["همه"].forEach(addOption)
        if(value === "خانه"){
            ["اجاره","شارژ ساختمان","وسایل منزل"].forEach(addOption);
        }else if(value === "قبوض"){
            ["آب","برق","گاز","تلفن","موبایل","اینترنت"].forEach(addOption);
        }else if(value === "خوراک"){
            ["پروتئین","میوه","سبزیجات","خاروبار","خشکبار","رستوران و فست فود","کافی شاپ"].forEach(addOption);
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
