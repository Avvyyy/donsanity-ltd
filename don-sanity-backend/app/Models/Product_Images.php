<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Images extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'Image Url'
    ];

    /**Definition of relationship between product_images and products table
     * 
     * This may be necessary in the long run e.g accessing othee products in a category based on an image.
     * It may not be needed but let's keep this here for now
     * **/

    // Definition of relationship between product_images and product_colours
    public function colours() {
        return $this->belongsTo(Product_Colours::class, 'product_color_id');
    }

}
