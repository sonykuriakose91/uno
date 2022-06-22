<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQuoteDetails extends Model
{
    use HasFactory; 

    protected $table = 'job_quote_details';
    public $timestamps = true;

    public $fillable = [
        'details',
    ];

    public function getjob()
    {
        return $this->hasOne('App\Models\Jobs', 'id', 'job_id');
    }

    public function getjobquote()
    {
        return $this->hasOne('App\Models\JobQuotes', 'id', 'job_quote_id');
    }

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'user_id');
    }

    public function getcustomer()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'user_id');
    }
}
