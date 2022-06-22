<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiyHelp extends Model
{
    use HasFactory;

    protected $table = 'diy_help';
    public $timestamps = true;


    public function diyhelpcommentsall()
    {
        return $this->hasMany('App\Models\DiyHelpComments', 'diy_help_id')->where('status',1);
    }

    public function diyhelpcomments()
    {
        return $this->hasMany('App\Models\DiyHelpComments', 'diy_help_id')->where('status',1);
    }

    public function diyhelpfirstcomments()
    {
        return $this->hasMany('App\Models\DiyHelpComments', 'diy_help_id')->where(['status' => 1,'diy_help_comment_id' => 0])->orderBy('id','desc');
    }

    public function diyhelpimages()
    {
        return $this->hasMany('App\Models\DiyHelpImages', 'diy_help_id');
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
