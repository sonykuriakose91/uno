<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsWishlist extends Model
{
    use HasFactory;

    protected $table = 'products_wishlist';
    public $timestamps = true;

    // public $fillable = [
    //     'title',
    //     'post_content',
    // ];

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'user_id');
    }

    public function getcustomer()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'user_id');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Bazaar', 'id', 'product_id');
    }

}
