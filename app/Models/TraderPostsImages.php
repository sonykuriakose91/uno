<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderPostsImages extends Model
{
    use HasFactory;

    protected $table = 'trader_posts_images';
    public $timestamps = true;

    public $fillable = [
        'post_image',
    ];

    public function gettraderpost()
    {
        return $this->hasOne('App\Models\TraderPosts', 'id', 'trader_post_id');
    }
}
