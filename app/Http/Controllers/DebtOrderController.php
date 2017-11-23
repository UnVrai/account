<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Common;
use App\Debtor;
use Illuminate\Http\Request;

class DebtOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('id')) {
            $debts = Debtor::find($request->get('id'))->debt()->orderBy('id', 'desc')->paginate(8);
        } else {
            $debts = Debt::orderBy('id', 'desc')->paginate(8);
        }
        return view('debt.index', ['debts' => $debts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $debt = Debt::orderBy('id', 'desc')->first();
        $serial = $debt ? $debt->id : 0;
        $result = Common::where('type', 'price')->get();
        $price = [];
        foreach ($result as $i) {
            $price = array_add($price, $i->name, $i->value);
        }
        return view('debt.create')->with('serial', $serial + 1)->with('price', (object)$price);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $debt = new Debt();
        $debt->id = $input['serial'];
        $debt->debtor_id = $input['id'];
        $debt->name = $input['name'];
        $debt->number = $input['number'];
        $debt->price = $input['price'];
        $debt->total = $input['total'];
        $debt->person = $input['person'];
        $debt->qkr = $input['debtor'];
        $debt->sponsor = $input['sponsor'];
        $debt->actual = $debt->total;
        $discount = json_decode($debt->debtor->discount,true);
        $name = ['粗沙' => 'cs',
            '公分石' => 'gfs',
            '细沙' => 'xs',
            '毛石' => 'ms',];
        if ($discount['type'] == 'qk' || $debt->debtor->account < 0) {
            if ($discount['discount'] == 'dc') {
                $debt->actual -= $discount[$name[$debt->name]];
            } elseif ($discount['discount'] == 'dj') {
                $debt->actual = $debt->number * $discount[$name[$debt->name]];
            }
        }
        if ($debt->save()) {
            return $debt->id;
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Debt::find($id)->delete();
    }
}
