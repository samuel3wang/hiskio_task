<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankController extends Controller
{
    function accounts() {
        return view('accounts');
    }

    function balances() {
        return view('balances', );
    }

    function balacesPost() {
        return view('balances', );
    }
    
}
