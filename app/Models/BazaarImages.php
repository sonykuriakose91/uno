<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BazaarImages extends Model
{
    use HasFactory;

    protected $table = 'bazaar_images';
    public $timestamps = true;

    public $fillable = [
        'product_image',
    ];

    public function getbazaar()
    {
        return $this->hasOne('App\Models\Bazaar', 'id', 'bazaar_id');
    }
}
