<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'email', 'user_id'
    ];

    public function address() {
        return $this->morphOne('App\Models\Address', 'addressable');
    }
}
