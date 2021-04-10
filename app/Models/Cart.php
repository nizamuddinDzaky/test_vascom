<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    
    public function details()
    {
        return $this->hasMany(CartDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
