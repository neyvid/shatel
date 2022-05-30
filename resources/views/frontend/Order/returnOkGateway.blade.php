<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row text-center">
        <div class="col-6 m-0 m-auto text-center returnOfBankWrap" dir="rtl">
            <div class="OrderStatusIcon mt-5">
                <i class="fa fas fa-check-circle fa-5x ok"></i>

                <p>پرداخت شما با موفقیت انجام شد و شماره تراکنش شما :</p>
                <p>{{ isset($status->RefID)? $status->RefID : '' }}</p>
                <p>می باشد</p>
            </div>
            <a href="/profile">برای مشاهده سفارش خود کلیک کنید کنید</a>
        </div>
        @if(isset($status->RefID))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'تبریک !',
                    text: 'پرداخت شما با موفقیت انجام شد و شماره تراکنش شما : ' + {{$status->RefID}} + 'می باشد',
                })
            </script>
        @endif

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>


</body>
</html>
