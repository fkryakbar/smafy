<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaCollection extends Model
{
    use HasFactory;

    protected $table = 'siswa_collection';

    protected $guarded = [];
    protected $casts = [
        'activities' => 'array'
    ];

    public function collection()
    {
        return $this->hasOne(Collection::class, 'slug', 'collection_slug');
    }
}
