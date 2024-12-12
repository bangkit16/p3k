<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KotakP3K extends Model
{
    use HasFactory;
    protected $table = 'kotak_p3k';
    protected $primaryKey = 'kotak_p3k_id';
    protected $fillable = ['lokasi'];

    public function p3ks()
    {
        return $this->hasMany(P3K::class, 'p3k_id');
    }

}
