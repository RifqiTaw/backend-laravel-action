<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class ConfirmPassword
{
    use AsAction;

    public function handle(Request $request)
    {
        if (!Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => 'Password does not match our records.',
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended('/dashboard');
    }
}
