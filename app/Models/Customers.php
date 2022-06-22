<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';
    public $timestamps = true;

    public $fillable = [
        'name',
        'email',
        'country_code',
        'mobile',
        'address',
        'location',
        'loc_latitude',
        'loc_longitude',
        'status',
        'profile_pic',
    ];

    public function getuser()
    {
        return $this->hasOne('App\Models\User', 'user_id', 'id')->where('user_type',"customer");
    }
}
