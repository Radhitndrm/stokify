<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $guarded = ['id'];

    public function scopeGenerateCode($query, $prefix = 'SPR')
    {
        $last = $query->where('code', 'like', '$prefix-%')->orderByDesc('code')->first();

        $number = $last ? (int) substr($last->code, strlen($prefix) + 1) + 1 : 1;
        return $prefix . '-' . str_pad($number, 2, '0', STR_PAD_LEFT);
    }

    public function scopeSearch($query)
    {
        return $this->when('search', fn($query) => $query->whereAny(['name', 'code'], 'like', '%' . request('search') . '%'));
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
