<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    //
    protected $guarded  = ['id'];
    public function scopeSearch()
    {
        return $this->when(request('search'), fn($query) => $query->where('name', 'like', '%' . request('search') . '%'));
        /**
         * Scope untuk memfilter data berdasarkan input pencarian 'search'.
         * Jika parameter 'search' tersedia di request, maka akan menambahkan
         * kondisi WHERE name LIKE '%search%'.
         *
         * Contoh penggunaan:
         * Category::search()->get();
         */
    }
}
