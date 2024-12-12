<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    // use HasFactory;

    protected $table = 'pemakaian';
    protected $primaryKey = 'pemakaian_id';
    protected $fillable = ['user_id', 'nama_pemakai', 'divisi', 'tanggal', 'jam_pemakaian', 'barang_id', 'jumlah_pemakaian', 'alasan_pemakaian', 'kotak_p3k_id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function kotakP3k()
    {
        return $this->belongsTo(KotakP3K::class, 'kotak_p3k_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }
}
