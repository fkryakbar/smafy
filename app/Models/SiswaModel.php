<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $guarded = [];


    public function get_answer()
    {
        return $this->hasMany(JawabanModel::class, 'u_id', 'u_id');
    }
}
