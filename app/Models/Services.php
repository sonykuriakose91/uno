<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'services';
    public $timestamps = true;

    public $fillable = [
        'category',
        'service',
        'description',
        'status',
    ];

    public function getcategory()
    {
        return $this->hasOne('App\Models\Categories', 'id', 'category');
    }

    public function getsubcategory()
    {
        return $this->hasOne('App\Models\Categories', 'id', 'sub_category');
    }
}
