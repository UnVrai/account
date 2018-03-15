<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    public static function boot() {
        parent::boot();

        static::saved(function($model) {
            $price = $model->number;
            $date = $model->created_at;

            Income::saveReport($date->format('Y-m-d'), 'd', $price);
            Income::saveReport($date->format('Y-m'), 'm', $price);
            Income::saveReport($date->format('Y'), 'Y', $price);

        });

        static::deleted(function($model){
            $price = $model->number;
            $date = $model->created_at;

            Income::deleteReport($date->format('Y-m-d'), $price);
            Income::deleteReport($date->format('Y-m'), $price);
            Income::deleteReport($date->format('Y'), $price);

        });
    }

    static function saveReport($date, $dateType, $price) {
        $account = Account::where('date', $date)->first();
        if ($account == null) {
            $account = new Report;
            $account->date = $date;
            $account->type = $dateType;
        }
        $account->income += $price;
        $account->total += $price;
        $account->save();
    }

    static function deleteReport($date, $price) {
        $account = Account::where('date', $date)->first();
        $account->income -= $price;
        $account->total -= $price;
        $account->save();
    }
}
