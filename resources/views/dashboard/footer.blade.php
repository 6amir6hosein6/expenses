<script src="{{asset("plugins/jquery/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset("js/jquery-ui.min.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.ajax({
        headers: {
            'X-API-KEY':'XMNvSzRUrAvmLPR4Kxi4CY8KirC6TCIJ9dZhhMY9EUCCcoDJyWeOQ7lXxvVS2v3J',
            'ACCEPT':'application/json'
        },
        type: 'GET',
        url: 'https://api.sms.ir/v1/credit',
        dataType: "json",
        crossDomain: true,
        success: function( response ) {
            document.getElementById('SMSPriceExist').innerHTML = "اعتبار پنل پیامک : " + (response['data']) + "  پیامک";
            if(response['data'] < 20){
                document.getElementById('SMSPriceExist').style = "color:red";
            }

        }

    });
</script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- Morris.js charts -->
<script src="{{asset("js/raphael-min.js")}}"></script>
<!-- Sparkline -->
<script src="{{asset("plugins/sparkline/jquery.sparkline.min.js")}}"></script>
<!-- jvectormap -->
<script src="{{asset("plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}"></script>
<script src="{{asset("plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset("plugins/knob/jquery.knob.js")}}"></script>
<!-- daterangepicker -->
<script src="{{asset("js/moment.min.js")}}"></script>
<script src="{{asset("plugins/daterangepicker/daterangepicker.js")}}"></script>
<!-- datepicker -->
<script src="{{asset("plugins/datepicker/bootstrap-datepicker.js")}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>
<!-- Slimscroll -->
<script src="{{asset("plugins/slimScroll/jquery.slimscroll.min.js")}}"></script>
<!-- FastClick -->
<script src="{{asset("plugins/fastclick/fastclick.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("dist/js/adminlte.js")}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset("plugins/morris/morris.min.js")}}"></script>
<script src="{{asset("dist/js/pages/dashboard.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("dist/js/demo.js")}}"></script>



