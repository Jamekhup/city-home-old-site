<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userProperty extends Model
{
    use HasFactory;
    protected $table = 'userposts';
    protected $fillable = [
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
        'user_id',
        'approve',
        'square_feet',
        'description',
    ];
}
