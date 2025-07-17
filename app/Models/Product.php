<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded = ['id'];

    public function scopeSearch($query)
    {
        return $this->when(request('search'), fn($query) => $query->whereAny(['name', 'sku'], 'like', '%' . request('search') . '%'))
            ->when(request('category') && request('category') !== 'all', fn($query) => $query->where('category_id', request('category')));
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_units()
    {
        return $this->hasMany(related: ProductUnit::class);
    }
}
