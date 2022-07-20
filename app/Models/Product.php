<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat_id',
        'name',
        'slug',
        'small_description',
        'description',
        'orginal_price',
        'seller_price',
        'image',
        'qty',
        'tax',
        'keyword',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
