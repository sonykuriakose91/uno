<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    public $timestamps = true;

    public $fillable = [
        'work_completed',
        'review',
        'recommend'
    ];

    public function getservice()
    {
        return $this->hasOne('App\Models\Services', 'id', 'service_id');
    }

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'trader_id');
    }

    public function getuser()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'user_id');
    }

    public function traderreviewcommentsall()
    {
        return $this->hasMany('App\Models\TraderReviewComments', 'review_id')->where('status',1);
    }

    public function traderreviewcomments()
    {
        return $this->hasMany('App\Models\TraderReviewComments', 'review_id')->where('status',1);
    }

    public function traderreviewfirstcomments()
    {
        return $this->hasMany('App\Models\TraderReviewComments', 'review_id')->where(['status' => 1,'review_comment_id' => 0])->orderBy('id','desc');
    }
}
