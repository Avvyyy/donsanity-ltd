<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'colours',
        'category_id',
        'viewable',
    ];

    // Specifies the primary key value for the model
    public function getRouteKeyName()
    {
        return 'slug';

    } 

    // Defines that a prodouct belongs to a single category
    public function category() {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    // Defines the relationship between the product_colors table and products table
    public function colours() {
        return $this->hasMany(Product_Colours::class);
    }

    // Defines the relationsip between the product_images table and products table
    public function images() {
        return $this->hasManyThrough(
            Product_Images::class, Product_Colours::class, 
            'product_id',
            'product_color_id',
            'id',
            'id'
    );
    }
}
