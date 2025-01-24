<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];

    // Defines the one-to-many relationshhip between the categories and products table
    // Allows the foreign key in the products table to link to the categories table's id
    public function products() {
        return $this->hasMany(Products::Class);
    }
}
