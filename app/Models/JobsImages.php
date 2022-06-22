<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsImages extends Model
{
    use HasFactory;

    protected $table = 'jobs_images';
    public $timestamps = true;

    public $fillable = [
        'offer_image',
    ];

    public function getjob()
    {
        return $this->hasOne('App\Models\Jobs', 'id', 'job_id');
    }
}
