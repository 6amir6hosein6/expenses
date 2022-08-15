<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>لیست اعضای خانواده</title>
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
                            لیست اعضای خانواده
                        </h1>
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
            <div class="container-fluid " style="overflow-x:auto;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"> نام</th>
                        <th scope="col">تلفن</th>
                        <th scope="col">کدملی</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <th>{{$member->name}}</th>
                            <th scope="col">{{$member->phone}}</th>
                            <th scope="col">{{$member->national_id}}</th>
                            <th scope="col">{{$member->title}}</th>
                            @if(auth()->user()->family_owner and $member->id != auth()->user()->id)
                                <th scope="col">
                                    <a style="font-size: 30px;"
                                       href="{{route('members.edit',['member'=>$member->id])}}"><i
                                            class="fa fa-edit"></i></a>
                                </th>
                                <th scope="col">

                                    <form method="post"
                                          action="{{route('members.destroy',['member'=>$member->id])}}"
                                          onSubmit="return confirm(' با حذف عضو تمام تراکنش های او نیز حذف میشود آیا مطمعا هستید؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            style="font-size: 30px;color: red;border: none;background-color: inherit"
                                            type="submit"><i class="fa fa-trash "></i></button>
                                    </form>
                                </th>
                            @else
                                <th></th>
                                <th></th>
                            @endif

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
