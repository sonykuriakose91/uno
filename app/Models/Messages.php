<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $table = 'messages';
    public $timestamps = true;

    public function getcustomerfrom()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'from_user_id');
    }

    public function gettraderfrom()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'from_user_id');
    }

    public function getcustomerto()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'to_user_id');
    }

    public function gettraderto()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'to_user_id');
    }

}
