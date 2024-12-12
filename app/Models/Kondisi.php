<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    use HasFactory;

    protected $table = 'kondisi';
    protected $primaryKey = 'kondisi_id';
    protected $fillable = ['kondisi_nama'];

    public function kondisiInputs()
    {
        return $this->hasMany(KondisiInput::class, 'kondisi_input_id');
    }
}
