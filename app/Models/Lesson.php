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

    public function students(): HasMany
    {
        return $this->hasMany(SiswaCollection::class, 'collection_slug', 'slug');
    }
}
