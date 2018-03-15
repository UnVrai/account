<?php

namespace App\Http\Controllers;

use App\Account;


class AccountController extends Controller
{
    public function __invoke($type='d')
    {
        $account = Account::where('type', $type)->orderBy('created_at', 'desc')->paginate(8);
        return view('account', ['account' => $account, 'type' => $type]);
    }
}
