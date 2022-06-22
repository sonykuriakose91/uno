<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BazaarCategory extends Model
{
    use HasFactory;

    protected $table = 'bazaar_category';
    public $timestamps = true;

    public $fillable = [
        'parent_category',
        'category',
        'description',
        'status',
    ];

    public function parentcategory()
    {
        return $this->hasOne('App\Models\BazaarCategory', 'id', 'parent_category');
    }

    public function subcategories()
    {
        return $this->hasMany('App\Models\BazaarCategory', 'parent_category');
    }
}
