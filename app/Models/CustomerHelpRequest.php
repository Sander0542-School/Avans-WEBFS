<?php

namespace App\Models;

use App\Events\CustomerRequestCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerHelpRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dispatchesEvents = [

        'created' => CustomerRequestCreated::class,

    ];
}
