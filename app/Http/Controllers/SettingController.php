<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common;
use Redirect;

class SettingController extends Controller
{
    public function show() {
        $result = Common::where('type', 'price')->get();
        $price = [];
        foreach ($result as $i) {
            $price = array_add($price, $i->name, $i->value);
        }
        return view('setting', ['price' => (object)$price]);
    }

    public function update(Request $request) {
        $input = $request->all();
        $this->savePrice('csPrice', $input['csPrice']);
        $this->savePrice('gfsPrice', $input['gfsPrice']);
        $this->savePrice('xsPrice', $input['xsPrice']);
        $this->savePrice('msPrice', $input['msPrice']);
        return Redirect::to('setting');
    }

    function savePrice($type, $price) {
        $common = Common::where('name', $type)->first();
        $common->value = $price;
        $common->save();
    }
}
