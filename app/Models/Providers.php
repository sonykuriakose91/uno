<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    use HasFactory;

    protected $table = 'providers';
    public $timestamps = true;

    public $fillable = [
        'type',
        'name',
        'provider_id',
        'email',
        'country_code',
        'mobile',
        'address',
        'available_time_from',
        'available_time_to',
        'is_available',
        'status',
        'featured',
        'rating',
        'profile_pic',
    ];

    public function providerdocuments()
    {
        return $this->hasMany('App\Models\ProviderDocuments', 'provider_id');
    }

    public function providerservices()
    {
        return $this->hasMany('App\Models\ProviderServices', 'provider_id');
    }

    public function providerworks()
    {
        return $this->hasMany('App\Models\ProviderWorks', 'provider_id');
    }

    public function providercategories()
    {
        return $this->hasMany('App\Models\ProviderCategories', 'provider_id');
    }

    public function providerservicelocations()
    {
        return $this->hasMany('App\Models\ProviderServicesLocations', 'provider_id');
    }

    public function getuser()
    {
        return $this->hasOne('App\Models\User', 'user_id', 'id')->where('user_type',"provider");
    }

    public function providerreviews()
    {
        return $this->hasMany('App\Models\Reviews', 'trader_id')->where('status',1)->orderBy('id','DESC');
    }

    public function providerposts()
    {
        return $this->hasMany('App\Models\TraderPosts', 'trader_id')->where('status',1)->orderBy('id','DESC');
    }

    public function provideroffers()
    {
        return $this->hasMany('App\Models\TraderOffers', 'trader_id')->orderBy('id','DESC');
    }

    public function providerfollows()
    {
        return $this->hasMany('App\Models\Follows', 'trader_id');
    }

    public function providerfavourites()
    {
        return $this->hasMany('App\Models\Favourites', 'trader_id');
    }
}
