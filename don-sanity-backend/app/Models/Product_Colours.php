<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Colours extends Model
{
    protected $table = 'product_colours';
    protected $fillable = [
        'Colour Name',
        'Colour Code'
    ];

    // Defining the relationship between the product_colours table and products table
    public function products() {
        return $this->belongsTo(Products::class, 'product_id');
    }

    // Defining the relationship between the product_colours table and products table
    public function images() {
        return $this->hasMany(Product_Images::class);
    }
}
