<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $guarded = ['id'];

    public function scopeSearch($query)
    {
        return $this->when('search', fn($query) => $query->where('name', 'like', '%' . request('search') . '%'));
    }
}
