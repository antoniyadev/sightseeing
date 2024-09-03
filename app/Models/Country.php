<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'iso2', 'iso3', 'phone_code', 'region', 'subregion'];
    public $timestamps = false;
}