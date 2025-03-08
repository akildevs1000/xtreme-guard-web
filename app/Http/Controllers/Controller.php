<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\PDFGenerate;
use App\Traits\JsonResponse;
use App\Traits\DatabaseOperations;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
    use JsonResponse;
    use PDFGenerate;
    use DatabaseOperations;

    public function checkRememberMe()
    {
        // Check if the remember_token cookie exists
        if ($rememberToken = Cookie::get('remember_token')) {
            // Find the user who has this remember token
            $user = User::where('remember_token', Crypt::encryptString($rememberToken))->first();

            if ($user) {
                // Log the user in manually (you may want to store user info in session)
                session(['user_id' => $user->id]);
            }
        }
    }
}
