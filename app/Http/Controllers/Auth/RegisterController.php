<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\ReferBonus;
use App\BusinessSetting;
use Carbon\Carbon;
use App\OtpConfiguration;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPVerificationController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Cookie;
use Nexmo;
use Twilio\Rest\Client;

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
    protected $redirectTo = '/';

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $otp = rand(0,9999999);
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'referred_by' => $data['referred_by'],
                'otp' => $otp,
            ]);
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->save();

                $email = $user['email'];
                Mail::raw("Please activate your account with $otp code.", function($message) use($email)
                    {
                        $message->from(env('MAIL_FROM_ADDRESS'), 'Online Shop');

                        $message->to($email);
                    });

        }
        else {
            if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated){
                $user = User::create([
                    'name' => $data['name'],
                    'phone' => '+'.$data['country_code'].$data['phone'],
                    'password' => Hash::make($data['password']),
                    'verification_code' => rand(100000, 999999),
                    'referred_by' => $data['referred_by'],
                ]);

                $customer = new Customer;
                $customer->user_id = $user->id;
                $customer->save();

                $otpController = new OTPVerificationController;
                $otpController->send_code($user);
            }
        }
    

        return $user;
    }


    public function register(Request $request)
    {
        if(User::where('referral_code', $request->referred_by)->first() == null){
                flash(translate('Code invalid.'))->error();
                return back();
        }
        else if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->email)->first() != null){
                flash(translate('Email or Phone already exists.'));
                return back();
            }
        }
        elseif (User::where('phone', '+'.$request->country_code.$request->phone)->first() != null) {
            flash(translate('Phone already exists.'));
            return back();
        }

        $this->validator($request->all())->validate();
        $userbonus = User::where('referral_code', $request->referred_by)->first();
        $bonus = ReferBonus::where('id',1)->first();
        $userbonus->balance = $userbonus->balance + $bonus->amount;

        $userbonus->save();

        $user = $this->create($request->all());

        //$this->guard()->login($user);
       // dd($user); die;
        $email = $user->email;
        if($user->email != null){
            if(BusinessSetting::where('type', 'email_verification')->first()->value != 1){
                $user->email_verified_at = date('Y-m-d H:m:s');
                $now = Carbon::now();
                $user->referral_code = 'pk-'.str::random(3).str::random(3).str::random(3).str::random(3);
                $user->save();
                flash(translate('Please check your mail and enter the otp number'))->success();
            }
            else {
                event(new Registered($user));
                flash(translate('Registration successfull. Please verify your email.'))->success();
            }
        }

        return view('frontend.otp_verification',compact('email'));
    }

    public function verifyOTP(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user->opt == $request->otp){
            $user->status = 1;
            $user->update();
        }
        $this->guard()->login($user);
        flash(translate('Your account activated successfully'))->success();
        return redirect()->route('home');
    }

    protected function registered(Request $request, $user)
    {
        if ($user->email == null) {
            return redirect()->route('verification');
        }
        else {
            return redirect()->route('opt.verification');
        }
    }

}
