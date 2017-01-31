<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactForm;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMessage(ContactForm $request)
    {
        Mail::to(config('mail.receiver_address'))->send(new ContactMessage($request->requiredFields()));

        return response()->json('ok');
    }
}
