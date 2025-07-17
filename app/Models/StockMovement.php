<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    //
    protected $guarded = ['id'];
    public function product_unit()
    {
        return $this->belongsTo(ProductUnit::class);
    }
}
