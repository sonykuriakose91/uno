<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderServices extends Model
{
    use HasFactory;

    protected $table = 'provider_services';
    public $timestamps = true;

    public $fillable = [
        'provider_id',
        'service_id',
        'status',
    ];


    public function getservice()
    {
        return $this->hasOne('App\Models\Services', 'id', 'service_id');
    }

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'provider_id');
    }
}
