<?php

namespace App\Http\Controllers;

use App\Debtor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Redirect;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('isAll')) {
            return Debtor::orderBy(DB::raw('convert(name using gbk)'))->get();
        }
        $debtors = Debtor::orderBy(DB::raw('convert(name using gbk)'))->paginate(8);
        $total = DB::select('select sum(account) as total from debtors')[0]->total;
        return view('debtor.index', ['debtors' => $debtors, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('debtor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $debtor = new Debtor();
        $debtor->name = $request->get('name');
        $debtor->tel = $request->get('tel');
        $debtor->debtor = $request->get('debtor');
        $debtor->sponsor = $request->get('sponsor');
        $debtor->max = $request->get('max');
        $days = $request->get('days');
        if ($days != '') {
            $next = Carbon::today();
            $next->addDay($days);
            $debtor->next = $next;
        }
        $json = ['type' => $request->get('type'),
            'discount' => $request->get('discount')];
        if ($json['discount'] != '0') {
            $json['cs'] = $request->get('cs');
            $json['gfs'] = $request->get('gfs');
            $json['xs'] = $request->get('xs');
            $json['ms'] = $request->get('ms');
        }
        $debtor->discount = json_encode($json);
        if ($debtor->save()) {
            return Redirect::to('/debtors');
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
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
        $debtor = Debtor::find($id);
        return view('debtor.edit', ['debtor' => $debtor, 'discount' => json_decode($debtor->discount)]);
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
        $debtor = Debtor::find($id);
        $debtor->name = $request->get('name');
        $debtor->tel = $request->get('tel');
        $debtor->debtor = $request->get('debtor');
        $debtor->sponsor = $request->get('sponsor');
        $debtor->max = $request->get('max');
        $days = $request->get('days');
        if ($days != '') {
            $next = Carbon::today();
            $next->addDay($days);
            $debtor->next = $next;
        }
        $json = ['type' => $request->get('type'),
            'discount' => $request->get('discount')];
        if ($json['discount'] != '0') {
            $json['cs'] = $request->get('cs');
            $json['gfs'] = $request->get('gfs');
            $json['xs'] = $request->get('xs');
            $json['ms'] = $request->get('ms');
        }
        $debtor->discount = json_encode($json);
        if ($debtor->save()) {
            return Redirect::to('/debtors');
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $debtor = Debtor::find($id);
        if ($debtor->account == 0) {
            $debtor->delete();
        }
    }
}
