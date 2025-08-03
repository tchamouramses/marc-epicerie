<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $code = Str::uuid();
            $model->code = Str::upper('prod' . substr($code, 0, 3) . substr(time() . '', -3));
        });
    }

    public function subCategory(): BelongsTo {
        return $this->belongsTo(SubCategory::class);
    }

    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }
}
