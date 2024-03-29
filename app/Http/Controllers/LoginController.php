<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginCount;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);
        LoginCount::where('user_id', $user->id)->increment('login_count');

        return $this->redirectTo($request, $user);
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {

        // to user dashboard
        if($user->isUser()) {
            return redirect()->intended();
        }

        abort(404);
    }

    protected function redirectTo(){
        if (Auth::user()->user_type == 'Administrator'){
            return redirect()->to('admin');  // admin dashboard path
        } 
        else {
            return redirect()->intended();  // member dashboard path
        }
}
}
