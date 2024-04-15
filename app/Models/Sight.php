<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sight extends Model
{
    use HasFactory;

    public function workingHours(): HasMany
    {
        return $this->hasMany(WorkingHour::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(SightImage::class);
    }

    public function coverImage()
    {
        return $this->hasOne(SightImage::class)->where('is_cover', 1);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
