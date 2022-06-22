<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $table = 'pages';
    public $timestamps = true;
    public static $page_types = ["about-us" => "About Us", "mission" => "Mission", "vision" => "Vision", "privacy-policy" => "Privacy Policy", "terms-and-conditions" => "Terms & Conditions"];

    public $fillable = [
        'page',
        'title',
        'contents',
        'status',
    ];
}
