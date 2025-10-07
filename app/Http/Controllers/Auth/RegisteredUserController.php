<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:' . User::class,
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['gmail.com','arb.com.my','jpph.gov.my','gov.my'];
                    $domain = strtolower(substr(strrchr($value, "@"), 1));
                    if (!in_array($domain, $allowedDomains)) {
                        $fail('The :attribute must be a JPPH or ARB company email address.');
                    }
                }
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'alamat_pejabat' => ['nullable', 'string', 'max:1000'],
            'no_tel' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat_pejabat' => $request->alamat_pejabat,
            'no_tel' => $request->no_tel,
            'role' => 'client',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}