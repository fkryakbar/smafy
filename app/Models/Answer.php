<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';
    protected $guarded = [];

    public function slide()
    {
        return $this->belongsTo(Slide::class, 'slide_id', 'id');
    }
    public function sublesson()
    {
        return $this->belongsTo(Sublesson::class, 'sublesson_slug', 'slug');
    }
}
