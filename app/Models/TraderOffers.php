<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderOffers extends Model
{
    use HasFactory;

    protected $table = 'trader_offers';
    public $timestamps = true;

    public $fillable = [
        'title',
        'full_price',
        'discount_price',
    ];

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'trader_id');
    }

    public function traderofferimages()
    {
        return $this->hasMany('App\Models\TraderOffersImages', 'trader_offer_id');
    }

    public function traderoffercommentsall()
    {
        return $this->hasMany('App\Models\TraderOffersComments', 'trader_offer_id')->where('status',1);
    }

    public function traderoffercomments()
    {
        return $this->hasMany('App\Models\TraderOffersComments', 'trader_offer_id')->where('status',1)->orderBy('id','desc');
    }

    public function traderofferfirstcomments()
    {
        return $this->hasMany('App\Models\TraderOffersComments', 'trader_offer_id')->where(['status' => 1,'offer_comment_id' => 0])->orderBy('id','desc');
    }

    public function traderofferlikes()
    {
        return $this->hasMany('App\Models\TraderOfferLikes', 'trader_offer_id');
    }
}
