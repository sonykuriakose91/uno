<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderPostsReports extends Model
{
    use HasFactory;

    protected $table = 'trader_posts_reports';
    public $timestamps = true;

    public $fillable = [
        'trader_post_id',
        'customer_id',
        'description',
    ];

    public function gettraderpost()
    {
        return $this->hasOne('App\Models\TraderPosts', 'id', 'trader_post_id');
    }

    public function getcustomer()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'customer_id');
    }
}
