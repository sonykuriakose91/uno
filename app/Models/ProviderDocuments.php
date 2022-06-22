<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderDocuments extends Model
{
    use HasFactory;

    protected $table = 'provider_documents';
    public $timestamps = true;

    public $fillable = [
        'provider_id',
        'proof_type',
        'id_type',
        'id_number',
        'document',
        'verified',
        'status',
    ];

    public function getprovider()
    {
        return $this->hasOne('App\Models\Providers', 'id', 'provider_id');
    }
}
