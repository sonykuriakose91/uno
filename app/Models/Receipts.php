<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipts extends Model
{
    use HasFactory;

    protected $table = 'receipts';
    public $timestamps = true;

    public function getcustomer()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'user_id');
    }

    public function gettrader()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'user_id');
    }

}
