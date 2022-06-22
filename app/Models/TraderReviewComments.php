<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderReviewComments extends Model
{
    use HasFactory;

    protected $table = 'trader_review_comments';
    public $timestamps = true;

    public $fillable = [
        'comment',
    ];

    public function gettraderreview()
    {
        return $this->hasOne('App\Models\Reviews', 'id', 'review_id');
    }

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'user_id');
    }

    public function getuser()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'user_id');
    }
}
