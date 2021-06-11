<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishAllergy extends Model
{
    use HasFactory;

    protected $primaryKey = null;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'dish_id',
        'allergy_id',
    ];
}
