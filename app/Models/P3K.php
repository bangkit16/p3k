<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P3K extends Model
{
    use HasFactory;

    protected $table = 'p3k';
    protected $primaryKey = 'p3k_id';
    protected $fillable = ['lokasi', 'barang_id', 'jumlah' ,'kotak_p3k_id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function kotakP3K()
    {
        return $this->belongsTo(KotakP3K::class, 'kotak_p3k_id');
    }
}
