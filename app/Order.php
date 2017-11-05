<?php

namespace App;

use Carbon\Carbon;
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
            $date = $model->created_at;

            Order::saveReport($date->format('Y-m-d'), 'd', $name, $number, $price);
            Order::saveReport($date->format('Y-m'), 'm', $name, $number, $price);
            Order::saveReport($date->format('Y'), 'Y', $name, $number, $price);

        });

        static::deleted(function($model){
            $price = $model->actual;
            $name = $model->name;
            $number = $model->number;
            $date = $model->created_at;

            Order::deleteReport($date->format('Y-m-d'), $name, $number, $price);
            Order::deleteReport($date->format('Y-m'), $name, $number, $price);
            Order::deleteReport($date->format('Y'), $name, $number, $price);

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
