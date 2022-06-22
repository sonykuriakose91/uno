<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderOffersImages extends Model
{
    use HasFactory;

    protected $table = 'trader_offers_images';
    public $timestamps = true;

    public $fillable = [
        'offer_image',
    ];

    public function gettraderoffer()
    {
        return $this->hasOne('App\Models\TraderOffers', 'id', 'trader_offer_id');
    }
}
