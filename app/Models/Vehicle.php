<?php

namespace App\Models;

use App\Models\Scopes\LimitedVehicleVisibilityScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['daily_rate', 'model', 'category_id', 'make_id'];

    protected static function booted(): void
    {
        static::addGlobalScope(new LimitedVehicleVisibilityScope);
    }

    public function make(): BelongsTo
    {
        return $this->belongsTo(Make::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
