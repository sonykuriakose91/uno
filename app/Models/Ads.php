<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $table = 'advertisements';
    public $timestamps = true;

    public static $page_types = ["home" => "Home", "about-us" => "About Us", "contact-us" => "Contact Us"];
}
