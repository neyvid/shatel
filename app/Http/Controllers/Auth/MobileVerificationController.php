<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Sms\SendSms;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class MobileVerificationController extends Controller
{


    public function verify(Request $request)
    {

        if (Auth::check()) {
            if (Auth::user()->mobile_verify_code == $request->hash) {
                Auth::user()->mobile_verified_at = Carbon::now();
                Auth::user()->mobile_verify_code = null;
                Auth::user()->save();
                return ['status' => true, 'auth' => Auth::user()];
            }
            return ['status' => false, 'message' => 'کد وارد شده صحیح نمی باشد.'];
        }
        return ['status' => false, 'message' => 'شما وارد سایت نشده اید، ابتدا وارد سایت شوید و سپس شماره همراه خود را تایید نمایید.'];


    }

    public function resend()
    {
        if (Auth::check()) {
            $mobile_verify_code = Str::random(6);
            Auth::user()->mobile_verify_code = $mobile_verify_code;
            Auth::user()->save();
            try {
                SendSms::sendSms(Auth::user()->mobile, Auth::user()->mobile_verify_code);
            } catch (\Exception $e) {
                return ('در هنگام ارسال پیامک اشکالی بوجود آمده است لطفا مجددا تلاش کنید.');
            }
        }
    }
}
