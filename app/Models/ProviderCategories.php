<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderCategories extends Model
{
    use HasFactory;

    protected $table = 'provider_categories';
    public $timestamps = true;

    public $fillable = [
        'provider_id',
        'category_id',
        'status',
    ];


    public function getcategory()
    {
        return $this->hasOne('App\Models\Categories', 'id', 'category_id');
    }

    public function getsubcategory()
    {
        return $this->hasOne('App\Models\Categories', 'id', 'sub_category_id');
    }

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'provider_id');
    }
}
