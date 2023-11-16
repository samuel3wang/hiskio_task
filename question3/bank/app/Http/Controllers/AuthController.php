<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login() {
        return view(view: 'login');
    }

    function register() {
        return view(view: 'register');
    }

    function loginPost(Request $request) {
        $request->validate([
            'account' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('account', 'password');
        if(Auth::attempt($credentials)) {
            return redirect()->intended('accounts');
        }
        return redirect(route('login'))->with("error", "Account or password is incorrect");
    }

    function registerPost(Request $request) {
        $request->validate([
            'account' => 'required',
            'password' => 'required',
            'confirm' => 'required|same:password',
        ]);

        $data['account'] = $request->account;
        $data['password'] = Hash::make($request->password);
        $user = Account::create($data);

        if (!$user){
            return redirect(route('register'))->with("error", "There was a problem creating your account");
        }
        return redirect(route('login'))->with("success", "Your account has been created successfully");
    }

    function logout() {
        Auth::logout();
        return redirect(route('login'));
    }
}
