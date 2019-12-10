<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    protected $table = 'products_images';

    protected $fillable = [
        'image', 'is_image'
    ];

    public function products(){
        return $this->belongsTo(Products::class);
    }

}
