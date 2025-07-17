<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReceive extends Model
{
    //
    protected $guarded = ['id'];

    public function scopeSearch($query)
    {
        return $this->when(request('search'), fn($query) => $query->where('receive_code', 'like', '%' . request('search') . '%'));
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function order_receive_details()
    {
        return $this->hasMany(OrderReceiveDetail::class);
    }
}
