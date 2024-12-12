<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'barang_id';
    protected $fillable = ['barang_nama', 'jumlah_standar'];

    public function inputChecklists()
    {
        return $this->hasMany(InputChecklist::class, 'barang_id');
    }

    public function pemakaians()
    {
        return $this->hasMany(Pemakaian::class, 'barang_id');
    }

    public function p3ks()
    {
        return $this->hasMany(P3k::class, 'barang_id');
    }
}
