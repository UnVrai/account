<?php

namespace App\Http\Controllers;

use App\Debtor;
use App\Income;
use Redirect;
use Illuminate\Http\Request;

class RepayController extends Controller
{
    public function create($id)
    {
        return view('repay', ['debtor' => Debtor::find($id)]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $income = new Income();
        $income->number = $input['repay'];
        $income->type = '还款';
        $income->person = $input['name'];
        $debtor = Debtor::find($input['id']);
        $debtor->account -= $input['number'];
        $income->description = $debtor->id.'冲账：'.$input['number'].'还欠：'.$debtor->account;
        $debtor->next = null;
        $debtor->save();
        if ($income->save()) {
            return Redirect::to('debtors');
        };
    }
}
