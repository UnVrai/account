<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public static function boot() {
        parent::boot();

        static::saved(function($model) {
            $price = $model->number;
            $date = $model->created_at;

            Expense::saveReport($date->format('Y-m-d'), 'd', $price);
            Expense::saveReport($date->format('Y-m'), 'm', $price);
            Expense::saveReport($date->format('Y'), 'Y', $price);

        });

        static::deleted(function($model){
            $price = $model->number;
            $date = $model->created_at;

            Expense::deleteReport($date->format('Y-m-d'), $price);
            Expense::deleteReport($date->format('Y-m'), $price);
            Expense::deleteReport($date->format('Y'), $price);

        });
    }

    static function saveReport($date, $dateType, $price) {
        $account = Account::where('date', $date)->first();
        if ($account == null) {
            $account = new Report;
            $account->date = $date;
            $account->type = $dateType;
        }
        $account->expense += $price;
        $account->total -= $price;
        $account->save();
    }

    static function deleteReport($date, $price) {
        $account = Account::where('date', $date)->first();
        $account->expense -= $price;
        $account->total += $price;
        $account->save();
    }
}
