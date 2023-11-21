<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Account;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function accounts()
    {
        $accounts = Account::all();
        $balances = Balance::all();

        $total = [];
        foreach ($accounts as $account) {

            // Get the latest balance for each account
            $latestBalance = Balance::where('account_id', $account->id)->latest('created_at')->first();
            $total[$account->id] = $latestBalance;
        }

        return view('accounts', compact('accounts', 'total'));
    }

    public function balances($id)
    {
        $account = Account::findOrFail($id);
        $balances = $account->balances;
        session(['id' => $id]);

        return view('balances', compact('account', 'balances'));
    }

    public function operate() {
        return view('operate');
    }

    public function operatePost(Request $request) 
    {
        $method = $request->input('method');
        $amount = $request->input('amount');
        
        $id = session('id');
        $total = Balance::where('account_id', $id)->latest('created_at')->first();

        // If the account has no balance need to create first
        if ($total == null) {
            $total = new Balance([
                'account_id' => $id,
                'amount'  => 0,
                'method'  => 'deposit',
                'balance' => 0,
            ]);
        }

        if ($method == 'withdrawal' && $total->balance - $amount < 0) {
            return redirect()->route('balances', ['id' => $id])->with('error', 'You don\'t have enough balance to withdraw');
        }

        if ($method == 'deposit') {
            $total = $total->balance + $amount;
        } else {
            $total = $total->balance - $amount;
        }

        $balance = new Balance([
            'account_id' => $id,
            'amount'  => $amount,
            'method'  => $method,
            'balance' => $total,
        ]);

        $account = Account::findOrFail($id);
        $account->balances()->save($balance);

        return redirect()->route('balances', ['id' => $account->id]);
    }
}
