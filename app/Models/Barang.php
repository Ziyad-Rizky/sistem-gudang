<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'barangs';

    protected $fillable = [
        'nama_barang',
        'kode',
        'kategori',
        'lokasi',
        'deskripsi',
        'stok'
    ];

    public function mutasis()
    {
        return $this->hasMany(Mutasi::class);
    }
}