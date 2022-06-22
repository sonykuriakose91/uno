<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bazaar extends Model
{
    use HasFactory;

    protected $table = 'bazaar';
    public $timestamps = true;

    public $fillable = [
        'category_id',
        'sub_category_id',
        'product',
        'price',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->hasOne('App\Models\BazaarCategory', 'id', 'category_id');
    }

    public function subcategory()
    {
        return $this->hasOne('App\Models\BazaarCategory','id', 'sub_category_id');
    }

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'added_by');
    }

    public function getuser()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'added_by');
    }

    public function bazaarimages()
    {
        return $this->hasMany('App\Models\BazaarImages', 'bazaar_id');
    }

    // public function productshortlist()
    // {
    //     return $this->hasOne('App\Models\ProductsWishlist', 'product_id')->where(['user_id'=>(Auth::guard('web')->check())?Auth::guard('web')->user()->user_id:0,'user_type'=>(Auth::guard('web')->check())?"'".Auth::guard("web")->user()->user_type."'":""]);
    // }
}
