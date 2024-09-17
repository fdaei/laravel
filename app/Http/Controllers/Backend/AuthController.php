<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\TokenRepository;

class AuthController extends Controller
{
    protected $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function Login()
    {
        return view('backend.auth.login');
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'mobile' => [
                'required',
                'string',
                'max:11',
                'exists:users,mobile',
                'regex:/^09[0-9]{9}$/'
            ],
        ]);

        $mobile = $request->input('mobile');
        $verificationCode = "123456";
        Cache::put('verification_code_' . $mobile, $verificationCode, now()->addMinutes(5));

        return redirect()->route('backend.auth.verifyForm')->with([
            'mobile' => $mobile,
            'message' => __('messages.verification_code_sent')
        ]);
    }

    public function showVerificationForm(Request $request)
    {

        $mobile = $request->session()->get('mobile');

        if (!$mobile) {
            return redirect()->route('login')->with([
                'error' => __('messages.mobile_not_set')
            ]);
        }

        return view('backend.auth.verify', ['mobile' => $mobile]);
    }


    public function verifyCodeAndLogin(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string|max:15|exists:users,mobile',
            'verification_code' => 'required|string|max:6',
            'password' => 'required|string|min:6',
        ]);

        $mobile = $request->input('mobile');
        $verificationCode = $request->input('verification_code');
        $password = $request->input('password');

        if (Cache::get('verification_code_' . $mobile) !== $verificationCode) {
            return redirect()->route('backend.auth.verifyForm')->withErrors([
                'verification_code' => __('validation.verification_code_invalid')
            ]);
        }

        $user = User::where('mobile', $mobile)->first();

        if (!$user) {
            return redirect()->route('backend.auth.verifyForm')->withErrors([
                'mobile' => __('validation.mobile_not_found')
            ]);
        }

        if (!Hash::check($password, $user->password)) {
            return redirect()->route('backend.auth.verifyForm')->withErrors([
                'password' => __('validation.password_invalid')
            ]);
        }

        Auth::login($user);


        $user->tokens->each(function ($token) {
            $token->delete();
        });


        $tokenResult = $user->createToken('Personal Access Token');
        $accessToken = $tokenResult->accessToken;

        return redirect()->route('backend.dashboard')->with([
            'message' => __('messages.login_success'),
            'access_token' => $accessToken,
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {

            $user->tokens->each(function ($token) {
                $token->delete();
            });
            Auth::logout();
        }

        return redirect()->route('login');
    }
}
