<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\Sms\SendSms;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $authType = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'username' => array('required', 'unique:users,email', 'unique:users,mobile', 'regex:/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)|09(0[1-5]|1[0-9]|2[0-2]|3[0-9]|9[4|8|9])-?[0-9]{3}-?[0-9]{4}$/'),
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $authType = filter_var($data['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        return User::create([
            $authType => $data['username'],
            'password' => Hash::make($data['password']),
        ]);


    }

    public function register(Request $request)
    {
        $authType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        if ($authType == 'mobile') {
            $this->validator($request->all())->validate();
            $user = User::create([
                $authType => $request->username,
                'password' => Hash::make($request->password),
                'mobile_verify_code' => Str::random(6),
            ]);
            $this->guard()->login($user);
            SendSms::sendSms($user->mobile, $user->mobile_verify_code);
            if ($response = $this->registered($request, $user)) {
                return $response;
            }
            return $request->wantsJson()
                ? new JsonResponse(['data' => auth()->user(), 'authType' => 'mobile'], 200)
                : redirect($this->redirectPath());
        } else {
            $this->validator($request->all())->validate();

            event(new Registered($user = $this->create($request->all())));

            $this->guard()->login($user);

            if ($response = $this->registered($request, $user)) {
                return $response;
            }
            return $request->wantsJson()
                ? new JsonResponse(['data' => auth()->user(), 'authType' => 'email'], 200)
                : redirect($this->redirectPath());
        }

    }
}


