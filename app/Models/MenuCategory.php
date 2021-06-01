<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'extra_option',
    ];

    protected $casts = [
        'extra_option' => 'boolean',
    ];

    public function dishes()
    {
        return $this->hasMany(Dish::class, 'category_id', 'id');
    }
}
