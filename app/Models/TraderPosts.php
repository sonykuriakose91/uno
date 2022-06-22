<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderPosts extends Model
{
    use HasFactory;

    protected $table = 'trader_posts';
    public $timestamps = true;

    public $fillable = [
        'title',
        'post_content',
    ];

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'trader_id');
    }

    public function traderpostimages()
    {
        return $this->hasMany('App\Models\TraderPostsImages', 'trader_post_id');
    }

    public function traderpostlikes()
    {
        return $this->hasMany('App\Models\TraderPostsLikes', 'trader_post_id');
    }

    public function traderpostcommentsall()
    {
        return $this->hasMany('App\Models\TraderPostsComments', 'trader_post_id')->where('status',1);
    }

    public function traderpostcomments()
    {
        return $this->hasMany('App\Models\TraderPostsComments', 'trader_post_id')->where('status',1)->orderBy('id','desc');
    }

    public function traderpostfirstcomments()
    {
        return $this->hasMany('App\Models\TraderPostsComments', 'trader_post_id')->where(['status' => 1,'post_comment_id' => 0])->orderBy('id','desc');
    }

    public function traderpostreports()
    {
        return $this->hasMany('App\Models\TraderPostsReports', 'trader_post_id');
    }
}
