<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    protected $guarded = [];

    public function bank_account()
    {
        return $this->hasMany(BankAccount::class);
    }
}
