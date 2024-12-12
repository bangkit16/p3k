<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiInput extends Model
{
    use HasFactory;
    protected $table = 'input_kondisi';
    protected $primaryKey = 'input_kondisi_id';
    protected $fillable = ['checklist_id', 'kondisi_id', 'sesuai', 'tindakan_perbaikan'];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'checklist_id');
    }

    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class, 'kondisi_id');
    }
}
