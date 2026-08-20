<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $fillable = ['nama_jenis'];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
