<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiyHelpImages extends Model
{
    use HasFactory;

    protected $table = 'diy_help_images';
    public $timestamps = true;

    public $fillable = [
        'diy_help_image',
    ];

    public function getdiyhelp()
    {
        return $this->hasOne('App\Models\DiyHelp', 'id', 'diy_help_id');
    }
}
