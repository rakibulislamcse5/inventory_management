<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'product_name',
        'product_desc',
        'product_stock',
        'product_price',
        'product_status',
        'regular_price',
        'product_image',
        'date'
    ];
    protected $table = "product";
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
}
