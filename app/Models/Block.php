<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $table = 'block';
    public $timestamps = true;


    public function gettrader()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'trader_id');
    }

    public function getcustomer()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'customer_id');
    }
}
