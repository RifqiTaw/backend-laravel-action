<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class SendEmailVerificationNotification
{
    use AsAction;

    public function handle(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    }
}
