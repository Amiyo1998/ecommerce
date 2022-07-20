<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'ip_address',
        'product_qnty',
        'price',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
