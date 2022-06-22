<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderOfferLikes extends Model
{
    use HasFactory;

    protected $table = 'trader_offer_likes';
    public $timestamps = true;

    public function gettraderoffer()
    {
        return $this->hasOne('App\Models\TraderOffers', 'id', 'trader_offer_id');
    }

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'user_id');
    }

    public function getuser()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'user_id');
    }
}
