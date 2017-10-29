<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    //

    public static function boot() {
        parent::boot();

        static::saved(function($model) {
            $price = $model->actual;
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $report = Report::where('date', $year.$month.$day)->first();
            if ($report == null) {
                $report = new Report;
                $report->date = $year.$month.$day;
                $report->type = 'd';
            }
            $report->order = $report->order + $price;
            $report->total = $report->total + $price;
            $report->save();

            $report = Report::where('date', $year.$month)->first();
            if ($report == null) {
                $report = new Report;
                $report->date = $year.$month;
                $report->type = 'm';
            }
            $report->order = $report->order + $price;
            $report->total = $report->total + $price;
            $report->save();

            $report = Report::where('date', $year)->first();
            if ($report == null) {
                $report = new Report;
                $report->date = $year;
                $report->type = 'Y';
            }
            $report->order = $report->order + $price;
            $report->total = $report->total + $price;
            $report->save();
        });

        static::deleted(function($model){
            $price = $model->actual;
            $year = date('Y');
            $month = date('m');
            $day = date('d');

            $report = Report::where('date', $year.$month.$day)->first();
            $report->order = $report->order - $price;
            $report->total = $report->total - $price;
            $report->save();

            $report = Report::where('date', $year.$month)->first();
            $report->order = $report->order - $price;
            $report->total = $report->total - $price;
            $report->save();

            $report = Report::where('date', $year)->first();
            $report->order = $report->order - $price;
            $report->total = $report->total - $price;
            $report->save();
        });
    }
}
