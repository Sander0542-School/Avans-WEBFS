<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDish extends Model
{
    use HasFactory;

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
