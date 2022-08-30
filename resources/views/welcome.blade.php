<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset("dist/css/custom-style.css")}}">
    <link rel="stylesheet" href="{{asset("dist/css/adminlte.min.css")}}">
    <link rel="stylesheet" href="{{asset("dist/css/bootstrap-rtl.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/font-awesome/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}">

    <style>
        * {
            box-sizing: border-box
        }

        body {
            font-family: "Vazir", sans-serif;
            direction: rtl;
            text-align: center;
            padding: 20px;
        }

        /* Style the tab */
        .tab {
            float: left;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            width: 30%;
            height: 220px;
        }

        /* Style the buttons inside the tab */
        .tab button {
            display: block;
            background-color: inherit;
            color: black;
            padding: 22px 16px;
            width: 100%;
            border: none;
            outline: none;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current "tab button" class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            float: left;
            padding: 0px 12px;
            width: 70%;
            border: 1px solid lightgray;
            height: 380px;
        }
    </style>
</head>
<body>

<h2>صفحه ورود به سایت</h2>
<p>در این بخش میتوانید از طریق فرم مورد نظر وارد شوید</p>

@if ($errors->any())
    <br>
    <div class="alert alert-error">
        @foreach ($errors->all() as $error)
            <span class="breadcrumb-item">{{$error}}</span>
        @endforeach
    </div>
@endif
@if (session('status'))
    <br>
    <div class="alert alert-success">
        <center>
            <li class="breadcrumb-item">{{ session('status') }}</li>
        </center>
    </div>
@endif
<br>
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">فرم ثبت نام سرپرست و تشکیل خانواده
    </button>
    <button class="tablinks" onclick="openCity(event, 'Paris')">فرم ورود به عنوان سرپرست خانواده</button>
    <button class="tablinks" onclick="openCity(event, 'Tokyo')">فرم ورود به عنوان عضو خانواده</button>
</div>

<div id="London" class="tabcontent">
    <form method="post" action="{{route('owner-signup')}}" enctype="multipart/form-data" style="width: 100%">
        @csrf
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">نام سرپرست</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                               placeholder="مثال : سعید سیرانی">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">شماره تلفن</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputPassword1"
                               placeholder="مثال : ۰۹۱۲۵۸۵۲۲۳۷">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">کدملی</label>
                        <input type="text" name="national_id" class="form-control" id="exampleInputEmail1"
                               placeholder="مثال : 00278587858">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">عنوان</label>
                        <input type="text" name="title" class="form-control" id="exampleInputPassword1"
                               value="سرپرست" readonly>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">رمز عبور</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">تکرار رمز عبور</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               id="exampleInputPassword1">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <center>
                            <button type="submit" class="btn btn-primary">ثبت خانواده</button>
                        </center>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

    </form>
</div>

<div id="Paris" class="tabcontent">
    <form method="post" action="{{route('owner-signin')}}" enctype="multipart/form-data" style="width: 100%">
        @csrf
        <div class="card-body">

            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">شماره تلفن سرپرست خانواده</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputPassword1"
                               placeholder="مثال : ۰۹۱۲۵۸۵۲۲۳۷">


                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>


            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">رمز عبور</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <center>
                            <input type="hidden" value="owner" name="type">
                            <button type="submit" class="btn btn-primary">ورود سرپرست خانواده</button>
                        </center>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

    </form>
</div>

<div id="Tokyo" class="tabcontent">
    <form method="post" action="{{route('owner-signin')}}" enctype="multipart/form-data" style="width: 100%">
        @csrf
        <div class="card-body">

            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">شماره تلفن عضو خانواده</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputPassword1"
                               placeholder="مثال : ۰۹۱۲۵۸۵۲۲۳۷">
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>


            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">رمز عبور</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <center>
                            <input type="hidden" value="notowner" name="type">
                            <button type="submit" class="btn btn-primary">ورود عضو خانواده</button>
                        </center>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

    </form>

</div>

<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

</body>
</html>
