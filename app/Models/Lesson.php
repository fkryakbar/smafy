<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'lessons';

    public function sublessons(): HasMany
    {
        return $this->hasMany(Sublesson::class, 'lesson_slug', 'slug');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class, 'lesson_slug', 'slug');
    }

    public function accuracy()
    {
        $participants = $this->participants;

        $score_total = 0;

        foreach ($participants as $key => $participant) {
            $score_total += $participant->score_total();
        }
        if (count($participants) > 0) {
            return round(($score_total / count($participants)), 2);
        }
        return  0;
    }
}
