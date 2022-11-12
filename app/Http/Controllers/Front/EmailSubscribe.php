<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\EmailSubscribe\EmailSubscribeRepository;
use Illuminate\Http\Request;


class EmailSubscribe extends Controller
{
    protected $emailSubscribeRepository;

    public function __construct()
    {
        $this->emailSubscribeRepository = new EmailSubscribeRepository();
    }

    public function create(Request $request)
    {
        $is_email_subscribed = $this->emailSubscribeRepository->all()->where('email', $request->subscribeEmail);
        if (count($is_email_subscribed)!==0) {
            return ['status' => false];
        } else {
            $this->emailSubscribeRepository->create([
                'email' => $request->subscribeEmail
            ]);
            return ['status' => true];
        }
    }
}
