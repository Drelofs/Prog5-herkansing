<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    public $timestamps = true;
    protected $casts = [
        'price' => 'float'
    ];
    protected $fillable = [
        'name',
        'model',
        'year',
        'description',
        'price',
        'created_at'
    ];
}
