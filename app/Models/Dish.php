<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'number',
        'addition',
        'name',
        'description',
        'price',
        'btw',
        'spiciness_level',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function dish_allergies()
    {
        return $this->hasMany(DishAllergy::class, 'dish_id', 'id');
    }

    public function allergies()
    {
        return $this->hasManyThrough(Allergy::class, DishAllergy::class, 'dish_id', 'id', 'id', 'allergy_id');
    }

    public function category()
    {
        return $this->hasOne(MenuCategory::class, 'id', 'category_id ');
    }

    public function getPriceIncAttribute()
    {
        return (($this->btw + 100) / 100) * $this->price;
    }
}
