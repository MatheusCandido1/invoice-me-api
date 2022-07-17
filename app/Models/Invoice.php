<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'description','fee','brl','euro','duty','subtotal','total','quote_time','status','company_id','customer_id','account_id'
    ];
}
