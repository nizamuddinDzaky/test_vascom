<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $appends = ['status_label'];
    
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0 && $this->payment->status == 0) {
            return '<span class="badge badge-secondary">Belum Bayar</span>';
        } elseif ($this->status == 1 && $this->payment->status == 1) {
            return '<span class="badge badge-primary">Perlu Diproses</span>';
        } elseif ($this->status == 2) {
            return '<span class="badge badge-info">Telah Diproses</span>';
        } elseif ($this->status == 3) {
            return '<span class="badge badge-info">Dikirim</span>';
        } elseif ($this->status == 4) {
            return '<span class="badge badge-success">Selesai</span>';
        } elseif ($this->status == 5) {
            return '<span class="badge badge-dark">Dibatalkan</span>';
        }
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
    
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
