
<div class="container">
    <div class="row">
        <div class="col-6 m-0 m-auto text-center returnOfBankWrap" dir="rtl">
            <div class="OrderStatusIcon mt-5">
                <i class="fa fas fa-check-circle fa-5x ok"></i>

                <p>پرداخت شما با موفقیت انجام شد و شماره تراکنش شما :</p>
                <p>{{ isset($status->RefID)? $status->RefID : '' }}</p>
                <p>می باشد</p>
            </div>
            <a href="/">برای برگشت به سایت کلیک کنید</a>
        </div>
    </div>
</div>
