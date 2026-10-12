<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instrument extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'condition',
        'quantity',
        'availability',
        'description',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}