<?php

namespace App\Http\Controllers;

use App\Debtor;
use Illuminate\Http\Request;
use DB;
use PhpParser\Node\Expr\Cast\Object_;

class CreateOrderController extends Controller
{
    //
    public function common() {
        $serial = DB::table('common')->where('name', 'commonSerial')->value('value');
        return view('order')->with('serial', $serial)->with('price', $this->getPrice());
    }

    public function debt() {
        $serial = DB::table('common')->where('name', 'deptSerial')->value('value');
        return view('debt')->with('serial', $serial);
    }

    function getPrice() {
        $result = DB::table('common')->select('name', 'value')->where('type', 'price')->get()->toArray();
        $price = [];
        foreach ($result as $i) {
            $price = array_add($price, $i->name, $i->value);
        }
        return (object)$price;
    }
}
