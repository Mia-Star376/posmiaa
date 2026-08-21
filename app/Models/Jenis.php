<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $fillable = ['nama_jenis', 'user_id'];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
