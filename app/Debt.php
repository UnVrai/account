<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    public static function boot() {
        parent::boot();

        static::saved(function($model) {
            $price = $model->actual;
            $name = $model->name;
            $number = $model->number;
            $date = $model->created_at;
            $debtor = $model->debtor;
            $debtor->number = $number;
            $debtor->account += $price;
            $debtor->save();

            Debt::saveReport($date->format('Y-m-d'), 'd', $name, $number, $price);
            Debt::saveReport($date->format('Y-m'), 'm', $name, $number, $price);
            Debt::saveReport($date->format('Y'), 'Y', $name, $number, $price);

        });

        static::deleted(function($model){
            $price = $model->actual;
            $name = $model->name;
            $number = $model->number;
            $date = $model->created_at;
            $debtor = $model->debtor;
            $debtor->account -= $price;
            $debtor->save();

            Debt::deleteReport($date->format('Y-m-d'), $name, $number, $price);
            Debt::deleteReport($date->format('Y-m'), $name, $number, $price);
            Debt::deleteReport($date->format('Y'), $name, $number, $price);

        });
    }

    static function saveReport($date, $dateType, $type, $number, $price) {
        $report = Report::where('date', $date)->first();
        $account = Account::where('date', $date)->first();
        if ($report == null) {
            $report = new Report;
            $report->date = $date;
            $report->type = $dateType;
        }
        if ($account == null) {
            $account = new Report;
            $account->date = $date;
            $account->type = $dateType;
        }
        $account->debt += $price;
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
        $account->save();
        $report->save();
    }

    static function deleteReport($date, $type, $number, $price) {
        $report = Report::where('date', $date)->first();
        $account = Account::where('date', $date)->first();
        $account->debt -= $price;
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
        $account->save();
    }

    public function debtor() {
        return $this->belongsTo('App\Debtor');
    }
}
