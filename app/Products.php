<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'user_id', 'product_name', 'description', 'status', 'sale_price', 'cost_price', 'quantity', 'minimum_quantity',
        'weight', 'ncm', 'cst_pis', 'cst_cofins', 'pis_percentage', 'cofins_percentage', 'cfop', 'ean', 'slug'
        ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'products_categories');
    }

}


