<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'email', 'phone', 'fantasy_name', 'user_id'
    ];

    public function address() {
        return $this->morphOne('App\Models\Address', 'addressable');
    }

    public function User() {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($company) {
            $company->user_id = auth()->user()->id;
        });
    }
}
