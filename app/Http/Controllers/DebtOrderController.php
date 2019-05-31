<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Common;
use App\Debtor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DebtOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = 0)
    {
        if ($id) {
            $debts = Debtor::find($id)->debt()->orderBy('id', 'desc')->withTrashed()->paginate(8);
        } else {
            $debts = Debt::orderBy('id', 'desc')->withTrashed()->paginate(8);
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
        $debt = Debt::orderBy('id', 'desc')->withTrashed()->first();
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
//        $debt->id = $input['serial'];
        $debt->debtor_id = $input['id'];
        if ($debt->debtor->max > 0 && $debt->debtor->account > $debt->debtor->max) {
            $error = [
                'message' => '欠款超过上限，无法开单！'
            ];
            return new JsonResponse($error, 403);
        }
        $date = Carbon::today();
        if ($debt->debtor->next && $date->gte(Carbon::parse($debt->debtor->next))) {
            $error = [
                'message' => '上个月账单未结清，无法开单！'
            ];
            return new JsonResponse($error, 403);
        }
        $debt->name = $input['name'];
        $debt->number = $input['number'];
        $debt->price = $input['price'];
        $debt->total = $input['total'];
        $debt->person = $input['person'];
        $debt->qkr = $input['debtor'];
        $debt->sponsor = $input['sponsor'];
        $debt->actual = round($debt->total);
        $discount = json_decode($debt->debtor->discount,true);
        $name = ['粗沙' => 'cs',
            '公分石' => 'gfs',
            '细沙' => 'xs',
            '毛石' => 'ms',];
        if ($discount['type'] == 'qk' || $debt->debtor->account < 0) {
            if ($discount['discount'] == 'dc') {
                $debt->actual -= $discount[$name[$debt->name]];
            } elseif ($discount['discount'] == 'dj' or $discount['discount'] == 'sf') {
                $debt->actual = $debt->number * $discount[$name[$debt->name]];
            }
            if ($discount['discount'] == 'sf') {
                $debt->type = '实方';
            } elseif ($discount['discount'] != '0') {
                $debt->type = '优惠';
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
