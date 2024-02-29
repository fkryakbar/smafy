<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sublesson extends Model
{
    use HasFactory;

    protected $table = 'sublessons';

    protected $guarded = [];

    public function questions(): HasMany
    {
        return $this->hasMany(Slide::class, 'sublesson_slug', 'slug')
            ->where(function ($query) {
                $query->where('type', '=', 'file_attachment')
                    ->orWhere('type', '=', 'multiple_choice')
                    ->orWhere('type', '=', 'short_answer')
                    ->orWhere('type', '=', 'long_answer');
            });
    }
}
