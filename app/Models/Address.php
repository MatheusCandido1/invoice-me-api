<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'zipcode',
        'state',
        'city',
        'neighborhood',
        'address',
        'number',
        'complement'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
