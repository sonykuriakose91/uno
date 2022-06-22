<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQuotes extends Model
{
    use HasFactory;

    protected $table = 'job_quotes';
    public $timestamps = true;

    // public $fillable = [
    //     'category_id',
    //     'sub_category_id',
    //     'description',
    // ];

    public function gettrader()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'trader_id');
    }

    public function getcustomer()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'customer_id');
    }

    public function getjob()
    {
        return $this->hasOne('App\Models\Jobs', 'id', 'job_id');
    }

    public function jobquotesdetailsfirst()
    {
        return $this->hasMany('App\Models\JobQuoteDetails', 'job_quote_id')->where(['job_quote_details_id' => 0])->orderBy('id','desc');
    }
}
