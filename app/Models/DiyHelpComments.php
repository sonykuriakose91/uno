<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiyHelpComments extends Model
{
    use HasFactory;

    protected $table = 'diy_help_comments';
    public $timestamps = true;


    public function diyhelp()
    {
        return $this->hasOne('App\Models\DiyHelp', 'id', 'diy_help_id');
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
