<?php

namespace App\Http\Controllers;

use App\Debtor;
use Illuminate\Http\Request;
use DB;

class CreateOrderController extends Controller
{
    //
    public function common() {
        $serial = DB::table('common')->where('id', 1)->value('number');
        return view('order')->with('serial', $serial);
    }

    public function debt() {
        $serial = DB::table('common')->where('id', 2)->value('number');
        return view('debt')->with('serial', $serial);
    }
}
