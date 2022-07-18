<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'number','beneficiary','bic_code',' company_id'
    ];

    public function Company() {
        return $this->belongsTo(Company::class);
    }

    public function scopeByCurrentCompany($query) {
        return $query->where('company_id', request()->header('X-Company-Id'));
    }

    protected static function booted() {
        static::creating(function ($account) {
            $account->company_id = $account->company_id ?
                $account->company_id
                :
                request()->header('X-Company-Id');
        });
    }
}
