<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LoginCount;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        $request->validate([
            'username' => 'required'
        ]);
        $user = User::create($request->validated());

        $login_count = LoginCount::create([
            'user_id' => $user->id,
            'login_count' => 1
        ]);

        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }
}
