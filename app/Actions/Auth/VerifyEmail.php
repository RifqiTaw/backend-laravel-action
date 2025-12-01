<?php

namespace App\Actions\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyEmail
{
    use AsAction;

    public function handle(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/dashboard');
    }
}
