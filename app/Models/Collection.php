<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Collection extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'collection';

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(PackageModel::class, 'collection_package', 'collection_slug', 'package_slug', 'slug', 'slug');
    }
}
