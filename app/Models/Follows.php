<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    use HasFactory;

    protected $table = 'follows';
    public $timestamps = true;

    public function getcustomer()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'user_id');
    }

    public function getfromtrader()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'user_id');
    }

    public function gettrader()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'trader_id');
    }

}
