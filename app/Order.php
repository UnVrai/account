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
            $name = $model->name;
            $number = $model->number;
            $year = date('Y');
            $month = date('m');
            $day = date('d');

            Order::saveReport($year.$month.$day, 'd', $name, $number, $price);
            Order::saveReport($year.$month, 'm', $name, $number, $price);
            Order::saveReport($year, 'Y', $name, $number, $price);

        });

        static::deleted(function($model){
            $price = $model->actual;
            $name = $model->name;
            $number = $model->number;
            $year = date('Y');
            $month = date('m');
            $day = date('d');

            Order::deleteReport($year.$month.$day, $name, $number, $price);
            Order::deleteReport($year.$month, $name, $number, $price);
            Order::deleteReport($year, $name, $number, $price);

        });
    }

    static function saveReport($date, $dateType, $type, $number, $price) {
        $report = Report::where('date', $date)->first();
        if ($report == null) {
            $report = new Report;
            $report->date = $date;
            $report->type = $dateType;
        }
        $report->order += $price;
        $report->total += $price;
        switch ($type) {
            case '粗沙': $report->csNum += $number;
                break;
            case '公分石': $report->gfsNum += $number;
                break;
            case '细沙': $report->xsNum += $number;
                break;
            case '毛石': $report->msNum += $number;
                break;
        }
        $report->save();
    }

    static function deleteReport($date, $type, $number, $price) {
        $report = Report::where('date', $date)->first();
        $report->order -= $price;
        $report->total -= $price;
        switch ($type) {
            case '粗沙': $report->csNum -= $number;
                break;
            case '公分石': $report->gfsNum -= $number;
                break;
            case '细沙': $report->xsNum -= $number;
                break;
            case '毛石': $report->msNum -= $number;
                break;
        }
        $report->save();
    }

}
