<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\EmailSubscribe\EmailSubscribeRepository;
use Illuminate\Http\Request;

class EmailSubscribe extends Controller
{
    protected $emailSubscribeRepository;

    public function __construct()
    {
        $this->emailSubscribeRepository=new EmailSubscribeRepository();
    }
}
