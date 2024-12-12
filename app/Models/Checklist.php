<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'checklist';
    protected $primaryKey = 'checklist_id';
    protected $fillable = ['tanggal', 'status', 'user_id' , 'kotak_p3k_id'];

    public function inputChecklists()
    {
        return $this->hasMany(InputChecklist::class, 'checklist_id');
    }

    public function kondisiInputs()
    {
        return $this->hasMany(KondisiInput::class, 'checklist_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }
    public function kotakP3k()
    {
        return $this->belongsTo(KotakP3K::class, 'kotak_p3k_id' , 'kotak_p3k_id');
    }
}
