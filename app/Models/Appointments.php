<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    public $timestamps = true;

    public $fillable = [
        'appointment_date',
        'appointment_time',
    ];

    public function gettrader()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'trader_id');
    }

    public function getuser()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'user_id');
    }
}
