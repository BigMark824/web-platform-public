<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GooberBlox\Account\Models\Account;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $account = Account::create([
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        $account->user()->create([ // add more
            'birth_date' => $request->input('birth_date'),
            'use_super_safe_conversation_mode' => false,
            'use_super_privacy_mode' => false,
            'conversation_safety_mode_is_locked' => false,
            'privacy_safety_mode_is_locked' => false,
        ]);

        event(new Registered($account));

        Auth::login($account);

        return redirect(route('dashboard', absolute: false));
    }
}
