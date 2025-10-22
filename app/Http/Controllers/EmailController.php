<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailRequest;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailController extends Controller
{
    public function showForm():View
    {
        return view('emails.create');
    }
    public function send(StoreEmailRequest $request){
        $data = $request->validated();

        $email = Email::create([
            'from_address' => $data['from'],
            'to_address'   => $data['to'],
            'cc_address'   => $data['cc'] ?? null,
            'subject'      => $data['subject'],
            'body'         => $data['body'],
            'type'         => $data['type'],
            'ip_address'   => $request->ip(),
            'user_agent'   => $request->userAgent(),
        ]);

        return redirect()->route('email.success', ['email' => $email->uuid]);
    }
    public function success(Email $email):View
    {

        return view('emails.success', compact('email'));
    }
}
