<?php

namespace App\Http\Controllers\Pages\Application;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function toSendMail($to, $mailClass, $object, $isQueued = false)
    {
        if ($isQueued) {
            // Use the queue method for sending the mail
            Mail::to($to)->queue(new $mailClass($object));
        } else {
            // Send the mail immediately
            Mail::to($to)->send(new $mailClass($object));
        }
    }
}
