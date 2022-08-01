<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | صفحه ورود</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("dist/css/adminlte.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset("plugins/iCheck/square/blue.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{asset("dist/css/bootstrap-rtl.min.css")}}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{asset("dist/css/custom-style.css")}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>ورود به سایت</b>

    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>

            @error('wrong_inf')
            <p class="login-box-msg" style="color: red">*{{ $message }}</p>
            @enderror

            <form action="{{route('signin')}}" method="post">
                @csrf
                <div class="row">
                    @error('phone')
                    <div class="error" style="color: red">*{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="phone" name="phone" class="form-control" placeholder="شماره موبایل">
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span>
                    </div>
                </div>

                <div class="row">
                    @error('password')
                    <div class="error" style="color: red">*{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="رمز عبور">
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                    </div>

                </div>

                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
                    </div>
                    <div class="col-4"></div>
                    <!-- /.col -->
                </div>
            </form>

{{--            <p class="mb-1">--}}
{{--                <a href="#">رمز عبورم را فراموش کرده ام.</a>--}}
{{--            </p>--}}
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset("plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- iCheck -->
<script src="{{asset("plugins/iCheck/icheck.min.js")}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass   : 'iradio_square-blue',
            increaseArea : '20%' // optional
        })
    })
</script>
</body>
</html>
