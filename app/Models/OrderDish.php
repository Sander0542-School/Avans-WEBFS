<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDish extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'dish_id',
        'order_id',
        'amount',
        'unit_price',
        'btw',
        'remark',
        'rice_option_id',
    ];

    protected $casts = [
        'unit_price' => 'double',
        'btw' => 'integer',
        'amount' => 'integer',
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id', 'id');
    }

    public static function create(array $attributes = [])
    {
        $attributes['unit_price'] = $attributes['unit_price'] ?? Dish::find($attributes['dish_id'] ?? 0, ['base_price'])->price ?? null;

        return static::query()->create($attributes);
    }

    public function getUnitPriceIncAttribute()
    {
        return (($this->btw + 100) / 100) * $this->unit_price;
    }

    public function getPriceIncAttribute()
    {
        return $this->unit_price_inc * $this->amount;
    }

    public function getPriceAttribute()
    {
        return $this->amount * $this->unit_price;
    }
}
