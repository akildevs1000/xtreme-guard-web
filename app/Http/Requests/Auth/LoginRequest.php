<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Events\UserLoginEvent;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public $loggedUserObj = [];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'remember' => ['nullable'],
            // 'captcha' => 'required|captcha'
        ];
    }

    public function authenticate(): void
    {
        // RateLimiter::clear($this->throttleKey());
        // Log::info($this->boolean('remember'));

        $user = $this->checkUserAvailability($this->only('username'));

        if (!$user || !$user->is_active) {
            throw ValidationException::withMessages([
                'username' => $user ? 'Your account is inactive. Please contact your administrator.' : 'The username you provided could not be found.',
            ]);
        }

        $this->loggedUserObj = $user;

        $this->ensureIsNotRateLimited();

        if ($user->password == $this->customEncrypt($this->only('password'))) {
            Auth::login($user);
            $this->intialSyncData();

            $this->checkRememberMe($user);
        } else {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    private function intialSyncData()
    {
        getMenu();
    }

    private function checkRememberMe($user)
    {
        if ($this->boolean('remember')) {

            $rememberToken = Str::random(60);

            $user->remember_token = Crypt::encryptString($rememberToken);
            $user->save();

            Cookie::queue('remember_token', $rememberToken, 60 * 24 * 5); // 5 days

            session(['user_id' => $user->id]);
        }
    }

    private function checkUserAvailability($request)
    {
        $user = User::where('username', $request['username'])
            ->with('roles')
            ->first();
        // dd($user);
        return  $user ? $user : false;
    }

    private function customEncrypt($pass)
    {
        $str = $pass['password'];
        $key = '4QcTlzuaNUcX289Z9D0ovPCzb';
        $iv = "1234567812345678";
        $encryption_key = base64_encode($key);
        $encrypted = openssl_encrypt($str, 'aes-256-cbc', $encryption_key, true, $iv);
        $encrypted_data = base64_encode($encrypted);
        return ($encrypted_data);
    }

    public function authenticateOld(): void
    {
        $this->ensureIsNotRateLimited();
        if (!Auth::attempt($this->only('username', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => 'ddd', // trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), $this->maxAttempts())) {
            if ($this->loggedUserObj = false) {
                User::where('id', $this->loggedUserObj['id'])->update(['is_active' => 0]);
            } else {
                logger("User ID is null. No update performed.");
                Log::info('User ID is null. No update performed');
            }

            Log::info($this->loggedUserObj);

            event(new Lockout($this));

            $seconds = RateLimiter::availableIn($this->throttleKey());


            $timeMessage = $seconds < 60
                ? trans('auth.throttle', ['minutes' => 0, 'seconds' => $seconds])
                : trans('auth.throttle', [
                    'minutes' => floor($seconds / 60),
                    'seconds' => $seconds % 60
                ]);

            throw ValidationException::withMessages([
                'username' => $timeMessage,
            ]);
        }

        RateLimiter::hit($this->throttleKey(), 1200);
        return;
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('username')) . '|' . $this->ip());
    }

    public function maxAttempts($maxAttempts = 3)
    {
        return  $maxAttempts ? $maxAttempts : 5;
    }

    public function messages(): array // Correct the function name to 'messages'
    {
        return [
            'captcha.captcha' => 'The captcha verification failed. Please try again.', // Update message for clarity
        ];
    }
}
