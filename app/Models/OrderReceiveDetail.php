<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReceiveDetail extends Model
{
    //
    protected $guarded = ['id'];

    public function order_receive()
    {
        return $this->belongsTo(OrderReceive::class);
    }

    public function order_detail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
