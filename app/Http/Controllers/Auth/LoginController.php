<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    protected function validateLogin(Request $request)
    {

        $request->validate([
            "username" => array('required', 'regex:/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)|09(0[1-5]|1[0-9]|2[0-2]|3[0-9]|9[4|8|9])-?[0-9]{3}-?[0-9]{4}$/'),
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        $username = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        return [
            $username => $request->username,
            'password' => $request->password
        ];

    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse(['data' => auth()->user()], 200)
            : redirect()->intended($this->redirectPath());
    }

    public function username()
    {
        return 'username';
    }

}
