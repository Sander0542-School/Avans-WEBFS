<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    public function allergies()
    {
        return $this->hasManyThrough(Allergy::class, DishAllergy::class, 'dish_id', 'id', 'id', 'allergy_id');
    }

    public function getPriceIncAttribute()
    {
        return  (($this->btw + 100) / 100) * $this->price;
    }
}
