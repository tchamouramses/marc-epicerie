<?php

namespace App\Models;

use App\Models\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $guarded = ['user_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Order $model) {
            $model->customer_id = Auth::id();
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
