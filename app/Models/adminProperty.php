<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminProperty extends Model
{
    use HasFactory;
    protected $table = 'adminposts';
    protected $fillable =[
        'saleRent',
        'category',
        'address',
        'township',
        'price',
        'money',
        'mainimage',
        'otherImage',
        'bedrooms',
        'bathrooms',
        'floor',
        'square_feet',
        'description',
    ];
}
