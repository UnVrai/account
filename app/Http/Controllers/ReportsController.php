<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __invoke($type='d')
    {
        $reports = Report::where('type', $type)->orderBy('created_at', 'desc')->paginate(8);
        return view('reports', ['reports' => $reports, 'type' => $type]);
    }
}
