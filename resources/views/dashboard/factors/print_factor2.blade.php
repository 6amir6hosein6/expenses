<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>چاپ فاکتور</title>
    <style>
        @font-face {
            font-family: Vazir;
            src: url('{{asset("dist/fonts/Vazir.eot")}}');
            src: url('{{asset("dist/fonts/Vazir.eot?#iefix")}}') format('embedded-opentype'),
            url('{{asset("dist/fonts/Vazir.woff2")}}') format('woff2'),
            url('{{asset("dist/fonts/Vazir.woff")}}') format('woff'),
            url('{{asset("dist/fonts/Vazir.ttf")}}') format('truetype');
            font-weight: normal;
        }

        @font-face {
            font-family: Vazir;
            src: url('{{asset("dist/fonts/Vazir-Bold.eot")}}');
            src: url('{{asset("dist/fonts/Vazir-Bold.eot?#iefix")}}') format('embedded-opentype'),
            url('{{asset("dist/fonts/Vazir-Bold.woff2")}}') format('woff2'),
            url('{{asset("dist/fonts/Vazir-Bold.woff")}}') format('woff'),
            url('{{asset("dist/fonts/Vazir-Bold.ttf")}}') format('truetype');
            font-weight: bold;
        }

        body {
            direction: rtl;
            text-align: right;
            /*font-family: 'Vazir', sans-serif !important;*/
        }

        .item1 {
            grid-area: header;
        }

        .item2 {
            grid-area: menu;
        }

        .item3 {
            grid-area: main;
        }

        .item4 {
            grid-area: right;
        }

        .item5 {
            grid-area: footer;
        }

        .grid-container {
            display: grid;
            grid-template-areas:
    'header header header header header header'
    'menu main main main right right'
    'menu footer footer footer footer footer';
            gap: 10px;
            background-color: #2196F3;
            padding: 10px;
        }

        .grid-container > div {
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 20px 0;
            font-size: 30px;
        }
    </style>
</head>
<meta charset="utf-8">
<body class="hold-transition sidebar-mini" style="">
<center>
    <div class="grid-container" style="width: 8cm;margin-left: 5cm">
        <div class="item1">
            <div>بسمه تعالی</div>
            <div>بار فروشی سیفعلی سیرانی و پسران</div>
            <div>
                <label>
                    تلفن حجره : 2232129 - 0423
                </label>
                <label>
                    سیفعلی سیرانی : 09141248299
                </label>
                <label>
                    سعید سیرانی : 09149241945
                </label>
                <label>
                    فرهاد سیرانی : 09148290018
                </label>
                <label>
                    فرزین سیرانی : 09148290018
                </label
            </div>
        </div>
        <div class="item2">Menu</div>
        <div class="item3">Main</div>
        <div class="item4">Right</div>
        <div class="item5">Footer</div>
    </div>
</center>
</body>
</html>
