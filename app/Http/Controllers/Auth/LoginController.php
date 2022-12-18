<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Facades\Crypt;

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
     * Where to redirect users aftezr login.
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

    public function newLogin(Request $request)
    {
        $rules = [
            "code"  => "required",
            "phone"     => [Rule::phone()->lenient()->country($request->get('code'))],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            flash()->warning(__('lang.Wrong Inputs'));
            return redirect('login');
        }
        // merge code with number
        $mergedNumber = $this->mergeNumberWithCode($request->get('phone'), $request->get('code'));
        // check if user are in database by number
        $user =  User::where('phone', $mergedNumber)->first();

        // if in database return to enter password page with the user's number  
        if ($user) {
            return redirect()->route('login-password-page', ['no' => Crypt::encryptString($user->id)]); // send email to form to login with it 
        } else {
            // if not in database but verify otp early 
            if (Session::has('verifiedOtp')) {
                return redirect()->route('register');
            } else {
                return $this->otp($mergedNumber);
            }
        }
    }
    public function loginPasswordPage(Request $request)
    {
        if (!$request->has('no')) {
            return redirect()->route('login');
        } else {
            try {
                $no =  Crypt::decryptString($request->get('no'));
                $user = User::find($no);
                return view('auth.passwords.password', ['user' => $user]);
            } catch (\Exception $th) {
                return redirect()->route('login');
            }
        }
    }
    public function submit(Request $request)
    {
        $rules = [
            "email"  => "required",
            "phone"     => "required",
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            flash()->warning(__('lang.otp'));
            return redirect('login');
        }
    }

    private function mergeNumberWithCode($phone, $code)
    {
        return PhoneNumber::make($phone, $code)->formatE164();
    }

    private function otp($number)
    {
        // flash()->warning(__('lang.otp'));
        return view('auth.otp',['number'=>$number]);
    }
    private function sendOTP()
    {
        
    }
}
