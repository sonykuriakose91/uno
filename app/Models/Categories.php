<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = true;

    public $fillable = [
        'parent_category',
        'category',
        'description',
        'icon',
        'status',
    ];

    public function parentcategory()
    {
        return $this->hasOne('App\Models\Categories', 'id', 'parent_category');
    }

    public function subcategories()
    {
        return $this->hasMany('App\Models\Categories', 'parent_category');
    }
}
