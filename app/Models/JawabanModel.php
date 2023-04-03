<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanModel extends Model
{
    use HasFactory;

    protected $table = 'jawaban';
    protected $guarded = [];

    public function get_soal()
    {
        return $this->hasOne(QuestionsModel::class, 'id', 'soal_id');
    }
}
