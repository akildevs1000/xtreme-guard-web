<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Administration\UserLoginActivityLog;

class TrackingUserLoginListen
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event)
    {
        if (Auth::check()) {

            $user = User::find(Auth::user()->id);

            $data = [
                'user_id' => $user->id,
                'action' => request()->route()->getName() === 'logout' ? 'logout' : 'login',
                'session_id' => session()->getId(),
                'status' => 'success',
            ];

            // Conditionally add login_time or logout_time
            if ($data['action'] === 'login') {
                $data['login_time'] = now();
            } elseif ($data['action'] === 'logout') {
                $data['logout_time'] = now();
            }

            UserLoginActivityLog::createLog($data);

            $user->session_id = request()->route()->getName() === 'logout' ? null : session()->getId();
            $user->save();

            $loginLog = 'Login => userID: ' . $user->id . "|" . 'username: ' . $user->first_name;
            Log::channel('loggedUser')->info($loginLog);
        }
    }
}
