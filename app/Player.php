<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    protected $fillable = ['first_name', 'last_name', 'DOB', 'nationality',
                           'position', 'market_value', 'is_test'];
}








