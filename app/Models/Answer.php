<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';
    protected $guarded = [];

    // public function get_soal()
    // {
    //     return $this->hasOne(QuestionsModel::class, 'id', 'soal_id');
    // }
}
