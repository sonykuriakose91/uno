<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    public $timestamps = true;

    public $fillable = [
        'category_id',
        'sub_category_id',
        'description',
    ];

    public function getcustomer()
    {
        return $this->hasOne('App\Models\Customers', 'id', 'user_id');
    }

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'user_id');
    }

    public function jobimages()
    {
        return $this->hasMany('App\Models\JobsImages', 'job_id');
    }

    public function getcategory()
    {
        return $this->hasOne('App\Models\Categories', 'id', 'category_id');
    }

    public function getsubcategory()
    {
        return $this->hasOne('App\Models\Categories', 'id', 'sub_category_id');
    }

    public function jobquotes()
    {
        return $this->hasMany('App\Models\JobQuotes', 'job_id');
    }

    public function jobquotesdetailsfirst()
    {
        return $this->hasMany('App\Models\JobQuoteDetails', 'job_id')->where(['job_quote_details_id' => 0])->orderBy('id','desc');
    }

}
