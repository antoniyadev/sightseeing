<?php

namespace App\Models;

use App\Observers\SightObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'images',
        'latitude',
        'longitude',
        'city_id',
        'address_street',
        'address_postcode',
        'price',
        'category_id'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function workingHours(): HasMany
    {
        return $this->hasMany(WorkingHour::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public static function booted()
    {
        parent::booted();
        self::observe(SightObserver::class);
    }
}
