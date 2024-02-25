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

    public function get_user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function get_slides(): HasMany
    {
        return $this->hasMany(QuestionsModel::class, 'package_slug', 'slug');
    }

    public function get_students(): HasMany
    {
        return $this->hasMany(SiswaModel::class, 'package_id', 'slug');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(JawabanModel::class, 'package_id', 'slug');
    }
}
