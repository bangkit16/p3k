<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputChecklist extends Model
{
    use HasFactory;

    protected $table = 'input_checklist';
    protected $primaryKey = 'input_checklist_id';
    protected $fillable = ['barang_id', 'checklist_id', 'jumlah_aktual', 'tanggal_kadaluwarsa', 'keterangan'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'checklist_id');
    }
}
