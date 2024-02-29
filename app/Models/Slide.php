<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slides';

    protected $guarded = [];

    protected $casts = [
        'format' => 'json',
    ];


    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'slide_id', 'id');
    }


    public static function boot()
    {
        parent::boot();

        self::deleting(function ($data) {
            if ($data->image_path) {
                Storage::disk('public')->delete($data->image_path);
            }
        });
    }
}
