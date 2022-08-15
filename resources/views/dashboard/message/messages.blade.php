<!DOCTYPE html>
<html>
<head>
    @include('dashboard.header')
    <title>پیام ها</title>
    <style>
        .conversation-wrap {
            box-shadow: -2px 0 3px #ddd;
            padding: 0;
            max-height: 400px;
            overflow: auto;
        }

        .conversation {
            padding: 5px;
            border-bottom: 1px solid #ddd;
            margin: 0;

        }

        .message-wrap {
            box-shadow: 0 0 3px #ddd;
            padding: 0;

        }

        .msg {
            padding: 5px;
            border-bottom: 1px solid #ddd;
            margin: 0;
        }

        .msg-wrap {
            padding: 10px;
            max-height: 400px;
            overflow: auto;
            width: 80% !important;
            flex: none;

        }

        .time {
            color: #bfbfbf;
        }

        .btn-panel .btn {
            color: #b8b8b8;

            transition: 0.2s all ease-in-out;
        }

        .btn-panel .btn:hover {
            color: #666;
            background: #f8f8f8;
        }

        .btn-panel .btn:active {
            background: #f8f8f8;
            box-shadow: 0 0 1px #ddd;
        }

        .btn-panel-conversation .btn, .btn-panel-msg .btn {

            background: #f8f8f8;
        }

        .btn-panel-conversation .btn:first-child {
            border-right: 1px solid #ddd;
        }

        .msg-wrap .media-heading {
            color: #c96d22;
            font-weight: 700;
        }


        .msg-date {
            background: none;
            text-align: center;
            color: #aaa;
            border: none;
            box-shadow: none;
            border-bottom: 1px solid #ddd;
        }


        body::-webkit-scrollbar {
            width: 12px;
        }


        /* Let's get this party started */
        ::-webkit-scrollbar {
            width: 6px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            /*        -webkit-border-radius: 10px;
                    border-radius: 10px;*/
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            /*        -webkit-border-radius: 10px;
                    border-radius: 10px;*/
            background: #ddd;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        }

        ::-webkit-scrollbar-thumb:window-inactive {
            background: #ddd;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('dashboard.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">پیام ها</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row" style="height: 400px;overflow-y: auto;">
                            @foreach($messages as $message)
                                <div class="message-wrap col-lg-12"
                                     style="background-color: #eaeaea;border-radius: 5px;padding: 20px">
                                    <center>
                                        <div class="msg-wrap" style="background-color: #343a40;border-radius: 5px">
                                            <div class="media msg">
                                                <div class="media-body">
                                                    <small class="pull-left time"><i class="fa fa-clock-o"></i>
                                                        {{$message->date}}</small>
                                                    <h6 class="media-heading pull-right">{{$message->user_name}}</h6>
                                                    <br>
                                                    <hr style="border-top: 2px solid gray;margin-top: 5px;margin-bottom: 5px">
                                                    <small class="col-lg-10" style="color: whitesmoke;text-align: -moz-right;float: right;padding: 10px">{{$message->message}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
