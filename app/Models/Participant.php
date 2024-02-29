<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = 'participants';

    protected $guarded = [];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'slug', 'lesson_slug');
    }
}
