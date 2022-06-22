<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderPostsLikes extends Model
{
    use HasFactory;

    protected $table = 'trader_posts_likes';
    public $timestamps = true;

    public function gettraderpost()
    {
        return $this->hasOne('App\Models\TraderPosts', 'id', 'trader_post_id');
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
