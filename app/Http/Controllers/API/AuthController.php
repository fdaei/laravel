<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Send registration verification code
    public function sendRegistrationVerificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|max:11|regex:/^09[0-9]{9}$/',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $mobile = $request->input('mobile');
        $cacheKey = 'registration_verification_code_' . $mobile;

        $requestCount = Cache::get($cacheKey . '_count', 0);

        if ($requestCount >= 10) {
            return response()->json(['error' => 'Too many requests. Please try again later.'], 429);
        }

        Cache::put($cacheKey . '_count', $requestCount + 1, now()->addMinutes(120));

        $verificationCode = "123456";
        Cache::put($cacheKey, $verificationCode, now()->addMinutes(5));

        return response()->json(['message' => 'Verification code sent.'], 200);
    }

    // Complete registration
    public function completeRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|max:11',
            'verification_code' => 'required|string|max:6',
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d]{6,}$/',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ], [
            'password.regex' => 'Password must be at least 6 characters long and include both letters and numbers.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $mobile = $request->input('mobile');
        $verificationCode = $request->input('verification_code');
        $password = $request->input('password');
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $address = $request->input('address');

        // Check the verification code
        if (Cache::get('registration_verification_code_' . $mobile) !== $verificationCode) {
            return response()->json(['error' => 'Invalid verification code.'], 400);
        }

        // Check if user already exists
        if (User::where('mobile', $mobile)->exists()) {
            return response()->json(['error' => 'User with this mobile number already exists.'], 400);
        }

        try {
            $user = User::create([
                'mobile' => $mobile,
                'password' => Hash::make($password),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'address' => $address
            ]);

            Auth::login($user);
            $tokenResult = $user->createToken('Personal Access Token');
            $accessToken = $tokenResult->accessToken;
            $refreshToken = $tokenResult->token->refresh_token;


            // Reset all attempt caches after successful registration
            Cache::forget('registration_verification_code_' . $mobile . '_count');

            return response()->json([
                'message' => 'Registration successful.',
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Registration failed: ' . $e->getMessage()], 500);
        }
    }

    // Send verification code for login
    public function sendVerificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|max:11|exists:users,mobile|regex:/^09[0-9]{9}$/',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $mobile = $request->input('mobile');
        $cacheKey = 'verification_code_' . $mobile;

        $requestCount = Cache::get($cacheKey . '_count', 0);

        if ($requestCount >= 10) {
            return response()->json(['error' => 'Too many requests. Please try again later.'], 429);
        }

        Cache::put($cacheKey . '_count', $requestCount + 1, now()->addMinutes(120));

        $verificationCode = "123456";
        Cache::put($cacheKey, $verificationCode, now()->addMinutes(5));

        return response()->json(['message' => 'Verification code sent.'], 200);
    }

    // Verify code and login
    public function verifyCodeAndLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|max:11|exists:users,mobile',
            'verification_code' => 'required|string|max:6',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $mobile = $request->input('mobile');
        $verificationCode = $request->input('verification_code');
        $password = $request->input('password');
        $cacheKey = 'verification_code_' . $mobile;

        // Check the verification code
        if (Cache::get($cacheKey) !== $verificationCode) {
            $failedAttempts = Cache::get($cacheKey . '_failed_attempts', 0) + 1;
            Cache::put($cacheKey . '_failed_attempts', $failedAttempts, now()->addMinutes(5));

            // Lock the account if too many failed attempts
            if ($failedAttempts >= 5) {
                return response()->json(['error' => 'Too many failed attempts with verification code. Please wait and try again later.'], 429);
            }

            return response()->json(['error' => 'Invalid verification code.'], 400);
        }

        // Reset failed attempts count for verification code
        Cache::forget($cacheKey . '_failed_attempts');

        $user = User::where('mobile', $mobile)->first();

        if (!Hash::check($password, $user->password)) {
            $failedPasswordAttempts = Cache::get($cacheKey . '_password_failed_attempts', 0) + 1;
            Cache::put($cacheKey . '_password_failed_attempts', $failedPasswordAttempts, now()->addMinutes(5));

            // Lock the account if too many failed password attempts
            if ($failedPasswordAttempts >= 3) {
                return response()->json(['error' => 'Too many failed attempts with password. Please wait and try again later.'], 429);
            }

            return response()->json(['error' => 'Invalid password.'], 400);
        }

        // Reset failed attempts count for password
        Cache::forget($cacheKey . '_password_failed_attempts');

        $tokenResult = $user->createToken('Personal Access Token');
        $accessToken = $tokenResult->accessToken;
        $refreshToken = $tokenResult->token->refresh_token;
        // Reset all attempt caches after successful login
        Cache::forget($cacheKey . '_count');
        Cache::forget($cacheKey);
        Cache::forget($cacheKey . '_failed_attempts');
        Cache::forget($cacheKey . '_password_failed_attempts');

        return response()->json([
            'message' => 'Login successful.',
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ], 200);
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->tokens->each(function ($token) {
                $token->delete();
            });
        }

        return response()->json(['message' => 'Logout successful.'], 200);
    }

    public function refreshToken(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string',
        ]);

        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post(env('APP_URL') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $request->input('refresh_token'),
                    'client_id' => env('PASSPORT_CLIENT_ID'),
                    'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                    'scope' => '',
                ],
            ]);

            return response()->json(json_decode((string) $response->getBody(), true));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Refresh token is invalid or expired.'], 401);
        }
    }


}
