<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'today_sale',
        'total_profit',
        'total_product',
        'sale_status',
        'date'
    ];
    protected $table = "sale";
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
