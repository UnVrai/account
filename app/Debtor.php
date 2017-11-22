<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    //

    public function debt() {
        return $this->hasMany('App\Debt');
    }
}
