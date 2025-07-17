<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $guarded = ['id'];

    public function scopeNotReceived()
    {
        $orderReceivesIds = OrderReceive::select('order_id')->pluck('order_id')->toArray();
        return $this->whereNotIn('id', $orderReceivesIds);
    }

    public function scopeSuccess()
    {
        return $this->where('status', 'success');
    }

    public function scopeSearch($query)
    {
        return $this->when(request('search'), fn($query) => $query->where('order_code', 'like', '%' . request('search') . '%'))
            ->when(request('supplier') && request('supplier') !== 'all', fn($query) => $query->where('supplier_id', request('supplier')));
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }


    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function order_receives()
    {
        return $this->hasMany(OrderReceive::class);
    }
}
